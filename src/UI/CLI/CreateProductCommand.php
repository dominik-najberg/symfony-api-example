<?php

namespace App\UI\CLI;

use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use App\Infrastructure\Repository\DoctrineProductRepository;
use Money\Currency;
use Money\Money;
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
    private DoctrineProductRepository $productRepository;

    public function __construct(DoctrineProductRepository $productRepository)
    {
        parent::__construct(self::$defaultName);
        $this->productRepository = $productRepository;
    }

    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription);
        $this->addArgument('product-name', InputArgument::OPTIONAL, 'Product name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $product = new Product(
            Uuid::uuid4(),
            Uuid::uuid4(),
            new Name($input->getArgument('product-name') ?: 'Product from CLI'),
            new Description(str_repeat('Long description ', 10)),
            new Money(1200, new Currency('PLN'))
        );

        $this->productRepository->add($product);

        $io->success('You have created a product.');

        return Command::SUCCESS;
    }
}
