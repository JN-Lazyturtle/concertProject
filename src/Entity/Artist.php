<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nameA = null;

    #[ORM\Column(length: 30)]
    private ?string $contactA = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $summaryA = null;

    #[ORM\ManyToMany(targetEntity: Concert::class, inversedBy: 'artists')]
    private Collection $concerts;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Picture $pictureA = null;

    #[ORM\ManyToMany(targetEntity: MusicStyle::class)]
    private Collection $musicStyles;

    public function __construct()
    {
        $this->concerts = new ArrayCollection();
        $this->musicStyles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameA(): ?string
    {
        return $this->nameA;
    }

    public function setNameA(string $nameA): self
    {
        $this->nameA = $nameA;

        return $this;
    }

    public function getContactA(): ?string
    {
        return $this->contactA;
    }

    public function setContactA(string $contactA): self
    {
        $this->contactA = $contactA;

        return $this;
    }

    public function getSummaryA(): ?string
    {
        return $this->summaryA;
    }

    public function setSummaryA(?string $summaryA): self
    {
        $this->summaryA = $summaryA;

        return $this;
    }

    /**
     * @return Collection<int, Concert>
     */
    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    public function addConcert(Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts->add($concert);
        }

        return $this;
    }

    public function removeConcert(Concert $concert): self
    {
        $this->concerts->removeElement($concert);

        return $this;
    }

    public function getPictureA(): ?Picture
    {
        return $this->pictureA;
    }

    public function setPictureA(Picture $pictureA): self
    {
        $this->pictureA = $pictureA;

        return $this;
    }

    /**
     * @return Collection<int, MusicStyle>
     */
    public function getMusicStyles(): Collection
    {
        return $this->musicStyles;
    }

    public function addMusicStyle(MusicStyle $musicStyle): self
    {
        if (!$this->musicStyles->contains($musicStyle)) {
            $this->musicStyles->add($musicStyle);
        }

        return $this;
    }

    public function removeMusicStyle(MusicStyle $musicStyle): self
    {
        $this->musicStyles->removeElement($musicStyle);

        return $this;
    }

    public function __toString(): string
    {
        return $this->nameA;
    }


}
