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
    private $UnitOfMeasureType;

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
        return $this->UnitOfMeasureType;
    }

    public function setUnitOfMeasureType(?UnitOfMeasureType $UnitOfMeasureType): self
    {
        $this->UnitOfMeasureType = $UnitOfMeasureType;

        return $this;
    }
}
