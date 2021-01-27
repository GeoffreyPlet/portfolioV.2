<?php

namespace App\Entity;

use App\Repository\HeaderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=HeaderRepository::class)
 */
class Header
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * 
     * @Assert\Length(min=30)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $display;

    /**
     * @ORM\OneToMany(targetEntity=Maquette::class, mappedBy="header")
     */
    private $maquettes;

    public function __construct()
    {
        $this->maquettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): self
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return Collection|Maquette[]
     */
    public function getMaquettes(): Collection
    {
        return $this->maquettes;
    }

    public function addMaquette(Maquette $maquette): self
    {
        if (!$this->maquettes->contains($maquette)) {
            $this->maquettes[] = $maquette;
            $maquette->setHeader($this);
        }

        return $this;
    }

    public function removeMaquette(Maquette $maquette): self
    {
        if ($this->maquettes->removeElement($maquette)) {
            // set the owning side to null (unless already changed)
            if ($maquette->getHeader() === $this) {
                $maquette->setHeader(null);
            }
        }

        return $this;
    }
}
