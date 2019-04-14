<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
    private $MenuLink;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MenuName;

    /**
     * @ORM\Column(type="integer")
     */
    private $MenuOrder;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $UserId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuLink(): ?string
    {
        return $this->MenuLink;
    }

    public function setMenuLink(string $MenuLink): self
    {
        $this->MenuLink = $MenuLink;

        return $this;
    }

    public function getMenuName(): ?string
    {
        return $this->MenuName;
    }

    public function setMenuName(string $MenuName): self
    {
        $this->MenuName = $MenuName;

        return $this;
    }

    public function getMenuOrder(): ?int
    {
        return $this->MenuOrder;
    }

    public function setMenuOrder(int $MenuOrder): self
    {
        $this->MenuOrder = $MenuOrder;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }
}
