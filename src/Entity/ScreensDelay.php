<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScreensDelayRepository")
 */
class ScreensDelay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $DgScreens;

    /**
     * @ORM\Column(type="bigint")
     */
    private $DgTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $GkScreens;

    /**
     * @ORM\Column(type="bigint")
     */
    private $GkTime;

    /**
     * @ORM\Column(type="bigint")
     */
    private $TimeStat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDgScreens(): ?int
    {
        return $this->DgScreens;
    }

    public function setDgScreens(int $DgScreens): self
    {
        $this->DgScreens = $DgScreens;

        return $this;
    }

    public function getDgTime(): ?int
    {
        return $this->DgTime;
    }

    public function setDgTime(int $DgTime): self
    {
        $this->DgTime = $DgTime;

        return $this;
    }

    public function getGkScreens(): ?int
    {
        return $this->GkScreens;
    }

    public function setGkScreens(int $GkScreens): self
    {
        $this->GkScreens = $GkScreens;

        return $this;
    }

    public function getGkTime(): ?int
    {
        return $this->GkTime;
    }

    public function setGkTime(int $GkTime): self
    {
        $this->GkTime = $GkTime;

        return $this;
    }

    public function getTimeStat(): ?int
    {
        return $this->TimeStat;
    }

    public function setTimeStat(int $TimeStat): self
    {
        $this->TimeStat = $TimeStat;

        return $this;
    }
}
