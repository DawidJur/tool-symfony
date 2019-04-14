<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotedGamesProfilesRepository")
 */
class PromotedGamesProfiles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $gameId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $news;

    /**
     * @ORM\Column(type="boolean")
     */
    private $screens;

    /**
     * @ORM\Column(type="boolean")
     */
    private $forum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    public function getDescription(): ?bool
    {
        return $this->description;
    }

    public function setDescription(bool $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNews(): ?bool
    {
        return $this->news;
    }

    public function setNews(bool $news): self
    {
        $this->news = $news;

        return $this;
    }

    public function getScreens(): ?bool
    {
        return $this->screens;
    }

    public function setScreens(bool $screens): self
    {
        $this->screens = $screens;

        return $this;
    }

    public function getForum(): ?bool
    {
        return $this->forum;
    }

    public function setForum(bool $forum): self
    {
        $this->forum = $forum;

        return $this;
    }
}
