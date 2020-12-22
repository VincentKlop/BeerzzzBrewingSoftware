<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientTypeRepository")
 */
class IngredientType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasureType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unitOfMeasurementType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\IngredientTypeField", mappedBy="ingredientType")
     */
    private $extraFields;

    public function __construct()
    {
        $this->extraFields = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnitOfMeasurementType(): ?UnitOfMeasureType
    {
        return $this->unitOfMeasurementType;
    }

    public function setUnitOfMeasurementType(?UnitOfMeasureType $unitOfMeasurementType): self
    {
        $this->unitOfMeasurementType = $unitOfMeasurementType;

        return $this;
    }

    /**
     * @return Collection|IngredientTypeField[]
     */
    public function getExtraFields(): Collection
    {
        return $this->extraFields;
    }

    public function addExtraField(IngredientTypeField $extraField): self
    {
        if (!$this->extraFields->contains($extraField)) {
            $this->extraFields[] = $extraField;
            $extraField->addIngredientType($this);
        }

        return $this;
    }

    public function removeExtraField(IngredientTypeField $extraField): self
    {
        if ($this->extraFields->contains($extraField)) {
            $this->extraFields->removeElement($extraField);
            $extraField->removeIngredientType($this);
        }

        return $this;
    }
}
