<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Value\Description;
use App\Entity\Value\Name;
use App\Exception\InvalidDescription;
use App\Exception\InvalidName;
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
        string $name,
        string $description,
        Money $price
    ) {
        if (strlen($description) < 100) {
            throw InvalidDescription::minLengthRequirement(100);
        }

        if (strlen($description) >= 255) {
            throw InvalidDescription::maxLengthRequirement(255);
        }

        if (strlen($name) > 100) {
            throw InvalidName::lengthRequirement(100);
        }

        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
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

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): Money
    {
        return new Money($this->amount, new Currency($this->currency));
    }
}
