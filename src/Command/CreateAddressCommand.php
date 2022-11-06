<?php

namespace App\Command;

use App\Entity\AddressUuid;
use App\Factory\AddressFactory;
use App\Repository\AddressHashRepository;
use App\Repository\AddressIntRepository;
use App\Repository\AddressUuidRepository;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'create:address')]
class CreateAddressCommand extends Command
{
    private const RECORDS = 200_000;

    public function __construct(
        private readonly AddressUuidRepository $uuidRepository,
        private readonly AddressHashRepository $hashRepository,
        private readonly AddressIntRepository $intRepository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $progressBar = new ProgressBar($output, self::RECORDS);

        $faker = Factory::create('pl_PL');

        for ($i = 0; $i <= self::RECORDS; $i++) {
            $progressBar->advance();

            $addresses = AddressFactory::build($faker);

            $this->uuidRepository->add($addresses['uuid'], ($i % 10_000) === 0);
            $this->hashRepository->add($addresses['hash'], ($i % 10_001) === 0);
            $this->intRepository->add($addresses['int'], ($i % 10_002) === 0);
        }

        $progressBar->finish();

        return Command::SUCCESS;
    }
}
