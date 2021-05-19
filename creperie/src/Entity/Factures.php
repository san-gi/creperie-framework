<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\FacturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturesRepository::class)
 *
 *  @ApiResource()
 */
class Factures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToMany(targetEntity=Crepe::class, inversedBy="factures")
     */
    private $crepes;

    /**
     * @ORM\OneToOne(targetEntity=Panier::class, mappedBy="facture", cascade={"persist", "remove"})
     */
    private $panier;

    public function __construct()
    {
        $this->crepes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
     * @return Collection|crepe[]
     */
    public function getCrepes(): Collection
    {
        return $this->crepes;
    }

    public function addCrepe(crepe $crepe): self
    {
        if (!$this->crepes->contains($crepe)) {
            $this->crepes[] = $crepe;
        }

        return $this;
    }

    public function removeCrepe(crepe $crepe): self
    {
        $this->crepes->removeElement($crepe);

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        // unset the owning side of the relation if necessary
        if ($panier === null && $this->panier !== null) {
            $this->panier->setFacture(null);
        }

        // set the owning side of the relation if necessary
        if ($panier !== null && $panier->getFacture() !== $this) {
            $panier->setFacture($this);
        }

        $this->panier = $panier;

        return $this;
    }
}
