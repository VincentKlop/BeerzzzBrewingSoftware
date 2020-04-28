<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventoryItemRepository")
 */
class InventoryItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IngredientType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredientType;

    /**
     * @ORM\Column(type="float")
     */
    private $count;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventoryItemFieldValue", mappedBy="inventoryItem", orphanRemoval=true)
     */
    private $inventoryItemFieldValues;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    public function __construct()
    {
        $this->inventoryItemFieldValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredientType(): ?IngredientType
    {
        return $this->ingredientType;
    }

    public function setIngredientType(?IngredientType $ingredientType): self
    {
        $this->ingredientType = $ingredientType;

        return $this;
    }

    public function getCount(): ?float
    {
        return $this->count;
    }

    public function setCount(float $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return Collection|InventoryItemFieldValue[]
     */
    public function getInventoryItemFieldValues(): Collection
    {
        return $this->inventoryItemFieldValues;
    }

    public function addInventoryItemFieldValue(InventoryItemFieldValue $inventoryItemFieldValue): self
    {
        if (!$this->inventoryItemFieldValues->contains($inventoryItemFieldValue)) {
            $this->inventoryItemFieldValues[] = $inventoryItemFieldValue;
            $inventoryItemFieldValue->setInventoryItem($this);
        }

        return $this;
    }

    public function removeInventoryItemFieldValue(InventoryItemFieldValue $inventoryItemFieldValue): self
    {
        if ($this->inventoryItemFieldValues->contains($inventoryItemFieldValue)) {
            $this->inventoryItemFieldValues->removeElement($inventoryItemFieldValue);
            // set the owning side to null (unless already changed)
            if ($inventoryItemFieldValue->getInventoryItem() === $this) {
                $inventoryItemFieldValue->setInventoryItem(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
