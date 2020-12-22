<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeMashRowsRepository")
 */
class RecipeMashRows
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $temperature;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unitOfMeasureTemprature;

    /**
     * @ORM\Column(type="integer")
     */
    private $timeInMinutes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipe", inversedBy="recipeMashRows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getUnitOfMeasureTemprature(): ?UnitOfMeasure
    {
        return $this->unitOfMeasureTemprature;
    }

    public function setUnitOfMeasureTemprature(?UnitOfMeasure $unitOfMeasureTemprature): self
    {
        $this->unitOfMeasureTemprature = $unitOfMeasureTemprature;

        return $this;
    }

    public function getTimeInMinutes(): ?int
    {
        return $this->timeInMinutes;
    }

    public function setTimeInMinutes(int $timeInMinutes): self
    {
        $this->timeInMinutes = $timeInMinutes;

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
}
