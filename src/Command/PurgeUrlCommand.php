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
    name: 'purge:url',
    description: 'Purge in varnish url',
)]
class PurgeUrlCommand extends Command
{
    private const URL = 'url';

    private const VARNISH_URL = 'http://varnish';
    private const DATA = [
        [
            'method' => 'GET',
            'label' => 'Create cache',
        ],
        [
            'method' => 'GET',
            'label' => 'Check cache is working',
        ],
        [
            'method' => 'PURGE',
            'label' => 'Purge',
        ],
        [
            'method' => 'GET',
            'label' => 'Check purge is working',
        ],
    ];

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::URL, InputArgument::OPTIONAL, 'Url for purge')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = sprintf(
            '%s%s',
            self::VARNISH_URL,
            $input->hasArgument(self::URL) ? $input->getArgument(self::URL) : ''
        );

        foreach (self::DATA as $data) {
            $output->writeln($data['label']);
            $response = $this->httpClient->request($data['method'], $url);

            $output->writeln($response->getContent());

            sleep(1);
        }

        return Command::SUCCESS;
    }
}
