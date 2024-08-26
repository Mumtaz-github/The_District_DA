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

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'artists')]
    private ?self $artist = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'artist')]
    private Collection $artists;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Disc>
     */
    #[ORM\OneToMany(targetEntity: Disc::class, mappedBy: 'artist')]
    private Collection $discs;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->discs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getArtist(): ?self
    {
        return $this->artist;
    }

    public function setArtist(?self $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(self $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->setArtist($this);
        }

        return $this;
    }

    public function removeArtist(self $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getArtist() === $this) {
                $artist->setArtist(null);
            }
        }

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Disc>
     */
    public function getDiscs(): Collection
    {
        return $this->discs;
    }

    public function addDisc(Disc $disc): static
    {
        if (!$this->discs->contains($disc)) {
            $this->discs->add($disc);
            $disc->setArtist($this);
        }

        return $this;
    }

    public function removeDisc(Disc $disc): static
    {
        if ($this->discs->removeElement($disc)) {
            // set the owning side to null (unless already changed)
            if ($disc->getArtist() === $this) {
                $disc->setArtist(null);
            }
        }

        return $this;
    }
}
