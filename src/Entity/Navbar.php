<?php

namespace App\Entity;

use App\Repository\NavbarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NavbarRepository::class)
 */
class Navbar
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
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Route::class, mappedBy="navbar")
     */
    private $route;

    /**
     * @ORM\OneToMany(targetEntity=Maquette::class, mappedBy="navbar")
     */
    private $maquettes;

    public function __construct()
    {
        $this->route = new ArrayCollection();
        $this->maquettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Route[]
     */
    public function getRoute(): Collection
    {
        return $this->route;
    }

    public function addRoute(Route $route): self
    {
        if (!$this->route->contains($route)) {
            $this->route[] = $route;
            $route->setNavbar($this);
        }

        return $this;
    }

    public function removeRoute(Route $route): self
    {
        if ($this->route->removeElement($route)) {
            // set the owning side to null (unless already changed)
            if ($route->getNavbar() === $this) {
                $route->setNavbar(null);
            }
        }

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
            $maquette->setNavbar($this);
        }

        return $this;
    }

    public function removeMaquette(Maquette $maquette): self
    {
        if ($this->maquettes->removeElement($maquette)) {
            // set the owning side to null (unless already changed)
            if ($maquette->getNavbar() === $this) {
                $maquette->setNavbar(null);
            }
        }

        return $this;
    }
}
