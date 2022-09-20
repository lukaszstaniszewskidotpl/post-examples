<?php

namespace App\Command;

use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'ban',
    description: 'Ban urls by regex',
)]
class BanCommand extends Command
{
    private const URLS = 'urls';

    private const REGEX = 'regex';

    private const VARNISH_URL = 'http://varnish';

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::REGEX,InputArgument::REQUIRED, 'Regex')
            ->addArgument(self::URLS, InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Urls')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $urls = $input->getArgument(self::URLS);

        $output->writeln('Create cache');
        $this->callToUrls($urls, $output);

        $output->writeln('Test is working cache');
        $this->callToUrls($urls, $output);

        $output->writeln('Create ban');
        $this->ban($urls, $input->getArgument(self::REGEX), $output);

        $output->writeln('Check if ban working');
        $this->callToUrls($urls, $output);

        $output->writeln('Check if cache working after ban');
        $this->callToUrls($urls, $output);

        return Command::SUCCESS;
    }

    private function callToUrls(array $urls, OutputInterface $output): void
    {
        foreach ($urls as $url) {
            $response = $this->httpClient->request(
                'GET',
                sprintf('%s%s', self::VARNISH_URL, $url)
            );

            $output->writeln($response->getContent());

            sleep(1);
        }
    }

    private function ban(mixed $urls, string $regex, OutputInterface $output): void
    {
        $response = $this->httpClient->request(
            'BAN',
            sprintf('%s%s', self::VARNISH_URL, current($urls)),
            [
                'headers' => [
                    'X-Purge-Regex' => $regex,
                ],
            ],
        );

        $output->writeln($response->getContent());
    }
}
