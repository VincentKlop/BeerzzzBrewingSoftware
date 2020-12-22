<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $targetAlcoholVolume;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $preBoilWater;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $startSG;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $endSG;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $IBU;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $targetColor;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $calculatedColor;

    /**
     * @var InventoryItem
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\InventoryItem")
     * @ORM\JoinColumn(nullable=false)
     */
    private $yeast;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $spargeWaterAmount;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var BeerStyle
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BeerStyle")
     * @ORM\JoinColumn(nullable=false)
     */
    private $style;

    /**
     * @var Collection|RecipeMaltRows[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeMaltRows", mappedBy="recipe", orphanRemoval=true, cascade={"persist"})
     */
    private $malts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeHopRows", mappedBy="recipe", orphanRemoval=true, cascade={"persist"})
     */
    private $hops;

    /**
     * @ORM\Column(type="float")
     */
    private $mashWaterAmount;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeMashRows", mappedBy="recipe", orphanRemoval=true, cascade={"persist"})
     */
    private $recipeMashRows;

    public function __construct()
    {
        $this->malts = new ArrayCollection();
        $this->hops = new ArrayCollection();
        $this->recipeMashRows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTargetAlcoholVolume(): ?float
    {
        return $this->targetAlcoholVolume;
    }

    public function setTargetAlcoholVolume(float $targetAlcoholVolume): self
    {
        $this->targetAlcoholVolume = $targetAlcoholVolume;

        return $this;
    }

    public function getPreBoilWater(): ?float
    {
        return $this->preBoilWater;
    }

    public function setPreBoilWater(float $preBoilWater): self
    {
        $this->preBoilWater = $preBoilWater;

        return $this;
    }

    public function getStartSG(): ?int
    {
        return $this->startSG;
    }

    public function setStartSG(int $startSG): self
    {
        $this->startSG = $startSG;

        return $this;
    }

    public function getEndSG(): ?int
    {
        return $this->endSG;
    }

    public function setEndSG(int $endSG): self
    {
        $this->endSG = $endSG;

        return $this;
    }

    public function getIBU(): ?int
    {
        return $this->IBU;
    }

    public function setIBU(int $IBU): self
    {
        $this->IBU = $IBU;

        return $this;
    }

    public function getTargetColor(): ?int
    {
        return $this->targetColor;
    }

    public function setTargetColor(int $targetColor): self
    {
        $this->targetColor = $targetColor;

        return $this;
    }

    public function getCalculatedColor(): ?int
    {
        return $this->calculatedColor;
    }

    public function setCalculatedColor(int $calculatedColor): self
    {
        $this->calculatedColor = $calculatedColor;

        return $this;
    }

    public function getYeast(): ?InventoryItem
    {
        return $this->yeast;
    }

    public function setYeast(?InventoryItem $yeast): self
    {
        $this->yeast = $yeast;

        return $this;
    }

    public function getSpargeWaterAmount(): ?float
    {
        return $this->spargeWaterAmount;
    }

    public function setSpargeWaterAmount(float $spargeWaterAmount): self
    {
        $this->spargeWaterAmount = $spargeWaterAmount;

        return $this;
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

    public function getStyle(): ?BeerStyle
    {
        return $this->style;
    }

    public function setStyle(?BeerStyle $style): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return Collection|RecipeMaltRows[]
     */
    public function getMalts(): Collection
    {
        return $this->malts;
    }

    public function addMalt(RecipeMaltRows $malt): self
    {
        if (!$this->malts->contains($malt)) {
            $this->malts[] = $malt;
            $malt->setRecipe($this);
        }

        return $this;
    }

    public function removeMalt(RecipeMaltRows $malt): self
    {
        if ($this->malts->contains($malt)) {
            $this->malts->removeElement($malt);
            // set the owning side to null (unless already changed)
            if ($malt->getRecipe() === $this) {
                $malt->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecipeHopRows[]
     */
    public function getHops(): Collection
    {
        return $this->hops;
    }

    public function addHop(RecipeHopRows $hop): self
    {
        if (!$this->hops->contains($hop)) {
            $this->hops[] = $hop;
            $hop->setRecipe($this);
        }

        return $this;
    }

    public function removeHop(RecipeHopRows $hop): self
    {
        if ($this->hops->contains($hop)) {
            $this->hops->removeElement($hop);
            // set the owning side to null (unless already changed)
            if ($hop->getRecipe() === $this) {
                $hop->setRecipe(null);
            }
        }

        return $this;
    }

    public function getMashWaterAmount(): ?float
    {
        return $this->mashWaterAmount;
    }

    public function setMashWaterAmount(float $mashWaterAmount): self
    {
        $this->mashWaterAmount = $mashWaterAmount;

        return $this;
    }

    /**
     * @return Collection|RecipeMashRows[]
     */
    public function getRecipeMashRows(): Collection
    {
        return $this->recipeMashRows;
    }

    public function addRecipeMashRow(RecipeMashRows $recipeMashRow): self
    {
        if (!$this->recipeMashRows->contains($recipeMashRow)) {
            $this->recipeMashRows[] = $recipeMashRow;
            $recipeMashRow->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeMashRow(RecipeMashRows $recipeMashRow): self
    {
        if ($this->recipeMashRows->contains($recipeMashRow)) {
            $this->recipeMashRows->removeElement($recipeMashRow);
            // set the owning side to null (unless already changed)
            if ($recipeMashRow->getRecipe() === $this) {
                $recipeMashRow->setRecipe(null);
            }
        }

        return $this;
    }
}
