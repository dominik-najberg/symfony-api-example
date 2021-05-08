<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Value\Description;
use App\Entity\Value\Name;
use Doctrine\ORM\Id\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineProductRepository")
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidInterface $categoryId;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\Column(type="string")
     */
    private string $amount;

    /**
     * @ORM\Column(type="string")
     */
    private string $currency;

    public function __construct(
        UuidInterface $id,
        UuidInterface $categoryId,
        Name $name,
        Description $description,
        Money $price
    ) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name->name();
        $this->description = $description->description();
        $this->amount = $price->getAmount();
        $this->currency = $price->getCurrency()->getCode();
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function categoryId(): UuidInterface
    {
        return $this->categoryId;
    }

    public function name(): Name
    {
        return new Name($this->name);
    }

    public function description(): Description
    {
        return new Description($this->description);
    }

    public function price(): Money
    {
        return new Money($this->amount, new Currency($this->currency));
    }
}
