<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameP = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alternativeNameP = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'picturesC')]
    private ?Concert $concert = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameP(): ?string
    {
        return $this->nameP;
    }

    public function setNameP(string $nameP): self
    {
        $this->nameP = $nameP;

        return $this;
    }

    public function getAlternativeNameP(): ?string
    {
        return $this->alternativeNameP;
    }

    public function setAlternativeNameP(?string $alternativeNameP): self
    {
        $this->alternativeNameP = $alternativeNameP;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getConcert(): ?Concert
    {
        return $this->concert;
    }

    public function setConcert(?Concert $concert): self
    {
        $this->concert = $concert;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNameP();
    }


}
