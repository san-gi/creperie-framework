<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 *
 * @ApiResource(
 *     paginationEnabled=false,
 *     normalizationContext={"groups"={"panier"}},
 *     )
 */

class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"panier"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Crepe::class, inversedBy="paniers")
     *
     */
    private $crepes;

    /**
     * @ORM\OneToOne(targetEntity=Factures::class, inversedBy="panier", cascade={"persist", "remove"})
     *
     * @Groups({"panier"})
     */
    private $facture;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"panier"})
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=CrepeCommande::class, mappedBy="panier")
     *
     * @Groups({"panier"})
     */
    private $CrepeCOmmande;

    public function __construct()
    {
        $this->crepes = new ArrayCollection();
        $this->CrepeCOmmande = new ArrayCollection();
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

    /**
     * @return Collection|CrepeCommande[]
     */
    public function getCrepeCOmmande(): Collection
    {
        return $this->CrepeCOmmande;
    }

    public function addCrepeCOmmande(CrepeCommande $crepeCOmmande): self
    {
        if (!$this->CrepeCOmmande->contains($crepeCOmmande)) {
            $this->CrepeCOmmande[] = $crepeCOmmande;
            $crepeCOmmande->setPanier($this);
        }

        return $this;
    }

    public function removeCrepeCOmmande(CrepeCommande $crepeCOmmande): self
    {
        if ($this->CrepeCOmmande->removeElement($crepeCOmmande)) {
            // set the owning side to null (unless already changed)
            if ($crepeCOmmande->getPanier() === $this) {
                $crepeCOmmande->setPanier(null);
            }
        }

        return $this;
    }
}
