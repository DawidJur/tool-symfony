<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotedGamesRepository")
 */
class PromotedGames
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
    private $GameName;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $CountryCode;

    /**
     * @ORM\Column(type="bigint")
     */
    private $DateOfUpdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameName(): ?string
    {
        return $this->GameName;
    }

    public function setGameName(string $GameName): self
    {
        $this->GameName = $GameName;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->CountryCode;
    }

    public function setCountryCode(string $CountryCode): self
    {
        $this->CountryCode = $CountryCode;

        return $this;
    }

    public function getDateOfUpdate(): ?int
    {
        return $this->DateOfUpdate;
    }

    public function setDateOfUpdate(int $DateOfUpdate): self
    {
        $this->DateOfUpdate = $DateOfUpdate;

        return $this;
    }
}
