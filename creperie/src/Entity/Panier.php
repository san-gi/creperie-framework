<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
#[ApiResource]
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Crepe::class, inversedBy="paniers")
     */
    private $crepes;

    /**
     * @ORM\OneToOne(targetEntity=Factures::class, inversedBy="panier", cascade={"persist", "remove"})
     */
    private $facture;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    public function __construct()
    {
        $this->crepes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Crepe[]
     */
    public function getCrepes(): Collection
    {
        return $this->crepes;
    }

    public function addCrepe(Crepe $crepe): self
    {
        if (!$this->crepes->contains($crepe)) {
            $this->crepes[] = $crepe;
        }

        return $this;
    }

    public function removeCrepe(Crepe $crepe): self
    {
        $this->crepes->removeElement($crepe);

        return $this;
    }

    public function getFacture(): ?Factures
    {
        return $this->facture;
    }

    public function setFacture(?Factures $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
