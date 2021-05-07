<?php

namespace App\Command;

use App\Application\Command\CreateProduct;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductCommand extends Command
{
    private MessageBusInterface $commandBus;

    protected static $defaultName        = 'app:create-product';
    protected static $defaultDescription = 'Add a short description for your command';

    public function __construct(MessageBusInterface $commandBus)
    {
        parent::__construct(self::$defaultName);
        $this->commandBus = $commandBus;
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
