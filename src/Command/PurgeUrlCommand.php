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
    public function __construct(private readonly HttpClientInterface $httpClient)
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('url', InputArgument::OPTIONAL, 'Url for purge')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = sprintf(
            '%s%s',
            'http://varnish',
            $input->hasArgument('url') ? $input->getArgument('url') : ''
        );

        foreach (['GET', 'GET', 'PURGE', 'GET'] as $method) {
            $response = $this->httpClient->request($method, $url);

            $output->writeln($response->getContent());

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                return Command::FAILURE;
            }

            sleep(1);
        }

        return Command::SUCCESS;
    }
}
