<?php

namespace App\UI\CLI;

use App\Application\Command\CreateProduct;
use App\Application\MessageBus\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateProductCommand extends Command
{
    protected static $defaultName        = 'app:create-product';
    protected static $defaultDescription = 'Add a short description for your command';

    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct(self::$defaultName);
    }

    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription);
        $this->addArgument('product-name', InputArgument::OPTIONAL, 'Product name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->commandBus->dispatch(
            new CreateProduct(
                Uuid::uuid4(),
                Uuid::uuid4(),
                $input->getArgument('product-name') ?: 'Product from CLI',
                str_repeat('Long description ', 10),
                1200,
                'PLN',
            )
        );

        $io->success('You have created a product.');

        return Command::SUCCESS;
    }
}
