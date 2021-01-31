<?php

namespace App\Entity;

use App\Repository\MaquetteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaquetteRepository::class)
 */
class Maquette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Header::class, inversedBy="maquettes")
     */
    private $header;

    /**
     * @ORM\Column(type="boolean")
     */
    private $selecting;

    /**
     * @ORM\ManyToOne(targetEntity=Navbar::class, inversedBy="maquettes")
     */
    private $navbar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeader(): ?Header
    {
        return $this->header;
    }

    public function setHeader(?Header $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getSelecting(): ?bool
    {
        return $this->selecting;
    }

    public function setSelecting(bool $selecting): self
    {
        $this->selecting = $selecting;

        return $this;
    }

    public function getNavbar(): ?Navbar
    {
        return $this->navbar;
    }

    public function setNavbar(?Navbar $navbar): self
    {
        $this->navbar = $navbar;

        return $this;
    }
}
