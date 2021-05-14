<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\GetProductsRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetProductsHandler implements MessageHandlerInterface
{
    private GetProductsRepository $products;

    public function __construct(GetProductsRepository $products)
    {
        $this->products = $products;
    }

    /**
     * @return ProductDTO[]
     */
    public function __invoke(GetProducts $query): iterable
    {
        return $this->products->getByCategoryId($query->categoryId());
    }
}
