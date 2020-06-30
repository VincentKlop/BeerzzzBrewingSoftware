<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeHopRowsRepository")
 */
class RecipeHopRows
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InventoryItem")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hop;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\Column(type="float")
     */
    private $targetAlpha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipe", inversedBy="hops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timeCount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unitOfMeasureTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHop(): ?InventoryItem
    {
        return $this->hop;
    }

    public function setHop(?InventoryItem $hop): self
    {
        $this->hop = $hop;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getTargetAlpha(): ?float
    {
        return $this->targetAlpha;
    }

    public function setTargetAlpha(float $targetAlpha): self
    {
        $this->targetAlpha = $targetAlpha;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getTimeCount(): ?int
    {
        return $this->timeCount;
    }

    public function setTimeCount(?int $timeCount): self
    {
        $this->timeCount = $timeCount;

        return $this;
    }

    public function getUnitOfMeasureTime(): ?UnitOfMeasure
    {
        return $this->unitOfMeasureTime;
    }

    public function setUnitOfMeasureTime(?UnitOfMeasure $unitOfMeasureTime): self
    {
        $this->unitOfMeasureTime = $unitOfMeasureTime;

        return $this;
    }
}
