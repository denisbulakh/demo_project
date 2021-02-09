<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\AdvisorRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\AdvisorInput;
use App\Dto\AdvisorOutput;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;

/**
 * @ApiResource(
 *     input=AdvisorInput::class,
 *     output=AdvisorOutput::class,
 *     itemOperations={
 *         "create_advisor"={"route_name"="create_advisor"},
 *         "get",
 *         "delete",
 *         "patch",
 *     },
 *     routePrefix="v1",
 * ),
 * @ApiFilter(
 *     filterClass=SearchFilter::class,
 *     properties={
 *         "id"="exact",
 *         "name"="word_start",
 *         "description"="partial"
 *     }
 * ),
 * @ApiFilter(
 *     filterClass=BooleanFilter::class,
 *     properties={"availability"}
 * ),
 * @ApiFilter(
 *     filterClass=RangeFilter::class,
 *     properties={"pricePerMinute"}
 * ),
 * @ApiFilter(
 *     filterClass=ExistsFilter::class,
 *     properties={"languages"}
 * ),
 * @ORM\Entity(repositoryClass=AdvisorRepository::class)
 */
class Advisor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string|null $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $availability;

    /**
     * @ORM\Column(type="float", name="price_per_minute")
     */
    private float $pricePerMinute;

    /**
     * @ORM\Column(type="array")
     */
    private array $languages = [];

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private string|null $image = null;

    public function getId(): int|null
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAvailability(): bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getPricePerMinute(): float
    {
        return $this->pricePerMinute;
    }

    public function setPricePerMinute(float $pricePerMinute): self
    {
        $this->pricePerMinute = $pricePerMinute;

        return $this;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getImage(): string|null
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
