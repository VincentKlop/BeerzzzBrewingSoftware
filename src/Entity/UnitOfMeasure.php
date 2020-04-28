<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnitOfMeasureRepository")
 */
class UnitOfMeasure
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
    private $unitOfMeasureType;

    /**
     * @ORM\Column(type="float")
     */
    private $factor;

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

    public function getUnitOfMeasureType(): ?UnitOfMeasureType
    {
        return $this->unitOfMeasureType;
    }

    public function setUnitOfMeasureType(?UnitOfMeasureType $unitOfMeasureType): self
    {
        $this->unitOfMeasureType = $unitOfMeasureType;

        return $this;
    }

    public function getFactor(): ?float
    {
        return $this->factor;
    }

    public function setFactor(float $factor): self
    {
        $this->factor = $factor;

        return $this;
    }
}
