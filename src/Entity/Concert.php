<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

#[ORM\Entity(repositoryClass: ConcertRepository::class)]
class Concert
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateC = null;

    #[ORM\OneToMany(mappedBy: 'concert', targetEntity: Booking::class, orphanRemoval: true)]
    private Collection $bookings;

    #[ORM\ManyToMany(targetEntity: 'Artist', inversedBy: 'concerts')]
    #[JoinTable(name: 'artist_concert')]
    private Collection $artists;

    #[ORM\ManyToOne(inversedBy: 'program')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConcertHall $concertHall = null;

    #[ORM\OneToMany(mappedBy: 'concert', targetEntity: Picture::class)]
    private Collection $picturesC;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->artists = new ArrayCollection();
        $this->picturesC = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->dateC;
    }

    public function setDateC(\DateTimeInterface $dateC): self
    {
        $this->dateC = $dateC;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setConcert($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getConcert() === $this) {
                $booking->setConcert(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->addConcert($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeConcert($this);
        }

        return $this;
    }

    public function getConcertHall(): ?ConcertHall
    {
        return $this->concertHall;
    }

    public function setConcertHall(?ConcertHall $concertHall): self
    {
        $this->concertHall = $concertHall;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPicturesC(): Collection
    {
        return $this->picturesC;
    }

    public function addPicturesC(Picture $picturesC): self
    {
        if (!$this->picturesC->contains($picturesC)) {
            $this->picturesC->add($picturesC);
            $picturesC->setConcert($this);
        }

        return $this;
    }

    public function removePicturesC(Picture $picturesC): self
    {
        if ($this->picturesC->removeElement($picturesC)) {
            // set the owning side to null (unless already changed)
            if ($picturesC->getConcert() === $this) {
                $picturesC->setConcert(null);
            }
        }

        return $this;
    }


}
