<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\ProductsViewRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetProductsHandler implements MessageHandlerInterface
{
    private ProductsViewRepository $products;

    public function __construct(ProductsViewRepository $products)
    {
        $this->products = $products;
    }

    /**
     * @return ProductDTO[]
     */
    public function __invoke(GetProducts $query): array
    {
        return $this->products->getProducts();
    }
}