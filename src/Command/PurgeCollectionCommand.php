<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'purge:collection',
    description: 'Purge collection urls by regex',
)]
class PurgeCollectionCommand extends Command
{
    private const URLS = 'urls';
    private const REGEX = 'regex';

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::URLS, InputArgument::IS_ARRAY, 'Urls')
            ->addArgument(self::REGEX,InputArgument::REQUIRED, 'Regex')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($input->getArgument(self::URLS) as $url) {
            $response = $this->httpClient->request('GET', $url);

            $output->writeln($response->getContent());

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                return Command::FAILURE;
            }

            sleep(1);
        }



        return Command::SUCCESS;
    }
}
