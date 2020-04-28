<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventoryItemFieldValueRepository")
 */
class InventoryItemFieldValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InventoryItem", inversedBy="inventoryItemFieldValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $inventoryItem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IngredientTypeField")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredientTypeField;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    public function __toString(): string
    {
        return sprintf('%s %s', $this->getValue(), $this->getIngredientTypeField()->getUnitOfMeasure()->getName());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventoryItem(): ?InventoryItem
    {
        return $this->inventoryItem;
    }

    public function setInventoryItem(?InventoryItem $inventoryItem): self
    {
        $this->inventoryItem = $inventoryItem;

        return $this;
    }

    public function getIngredientTypeField(): ?IngredientTypeField
    {
        return $this->ingredientTypeField;
    }

    public function setIngredientTypeField(?IngredientTypeField $ingredientTypeField): self
    {
        $this->ingredientTypeField = $ingredientTypeField;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }
}
