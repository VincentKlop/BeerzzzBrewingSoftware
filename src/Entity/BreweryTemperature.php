<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BreweryTemperatureRepository")
 */
class BreweryTemperature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brewery")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Brewery;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sensorAddress;

    /**
     * @ORM\Column(type="float")
     */
    private $temperature;

    /**
     * @ORM\Column(type="datetime")
     */
    private $receivedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrewery(): ?Brewery
    {
        return $this->Brewery;
    }

    public function setBrewery(?Brewery $Brewery): self
    {
        $this->Brewery = $Brewery;

        return $this;
    }

    public function getSensorAddress(): ?string
    {
        return $this->sensorAddress;
    }

    public function setSensorAddress(string $sensorAddress): self
    {
        $this->sensorAddress = $sensorAddress;

        return $this;
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

    public function getReceivedAt(): ?\DateTimeInterface
    {
        return $this->receivedAt;
    }

    public function setReceivedAt(\DateTimeInterface $receivedAt): self
    {
        $this->receivedAt = $receivedAt;

        return $this;
    }
}
