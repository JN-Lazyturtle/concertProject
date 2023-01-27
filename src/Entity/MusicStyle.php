<?php

namespace App\Entity;

use App\Repository\MusicStyleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicStyleRepository::class)]
class MusicStyle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nameMS = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMS(): ?string
    {
        return $this->nameMS;
    }

    public function setNameMS(string $nameMS): self
    {
        $this->nameMS = $nameMS;

        return $this;
    }
}
