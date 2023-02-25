<?php

namespace App\Entity;

use App\Repository\ConcertHallRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertHallRepository::class)]
class ConcertHall
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nameH = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\OneToMany(mappedBy: 'concertHall', targetEntity: Concert::class, orphanRemoval: true)]
    private Collection $program;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $renovationStartDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $renovationEndDate = null;

    public function __construct()
    {
        $this->program = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameH(): ?string
    {
        return $this->nameH;
    }

    public function setNameH(string $nameH): self
    {
        $this->nameH = $nameH;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection<int, Concert>
     */
    public function getProgram(): Collection
    {
        return $this->program;
    }

    public function addProgram(Concert $program): self
    {
        if (!$this->program->contains($program)) {
            $this->program->add($program);
            $program->setConcertHall($this);
        }

        return $this;
    }

    public function removeProgram(Concert $program): self
    {
        if ($this->program->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getConcertHall() === $this) {
                $program->setConcertHall(null);
            }
        }

        return $this;
    }

    public function getRenovationStartDate(): ?\DateTimeInterface
    {
        return $this->renovationStartDate;
    }

    public function setRenovationStartDate(?\DateTimeInterface $renovationStartDate): self
    {
        $this->renovationStartDate = $renovationStartDate;

        return $this;
    }

    public function getRenovationEndDate(): ?\DateTimeInterface
    {
        return $this->renovationEndDate;
    }

    public function setRenovationEndDate(?\DateTimeInterface $renovationEndDate): self
    {
        $this->renovationEndDate = $renovationEndDate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nameH;
    }


}
