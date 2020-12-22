<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientTypeFieldRepository")
 */
class IngredientTypeField
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\IngredientType", inversedBy="extraFields")
     */
    private $ingredientType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UnitOfMeasure;

    public function __construct()
    {
        $this->ingredientType = new ArrayCollection();
        $this->unitOfMeasure = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return sprintf(
            '%s :: %s',
            $this->getUnitOfMeasure()->getUnitOfMeasureType()->getName(),
            $this->getUnitOfMeasure()->getName()
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|IngredientType[]
     */
    public function getIngredientType(): Collection
    {
        return $this->ingredientType;
    }

    public function addIngredientType(IngredientType $ingredientType): self
    {
        if (!$this->ingredientType->contains($ingredientType)) {
            $this->ingredientType[] = $ingredientType;
        }

        return $this;
    }

    public function removeIngredientType(IngredientType $ingredientType): self
    {
        if ($this->ingredientType->contains($ingredientType)) {
            $this->ingredientType->removeElement($ingredientType);
        }

        return $this;
    }

    public function getUnitOfMeasure(): ?UnitOfMeasure
    {
        return $this->UnitOfMeasure;
    }

    public function setUnitOfMeasure(?UnitOfMeasure $UnitOfMeasure): self
    {
        $this->UnitOfMeasure = $UnitOfMeasure;

        return $this;
    }
}
