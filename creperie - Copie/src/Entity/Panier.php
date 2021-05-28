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
 *     normalizationContext={"groups"={"pa"}},
 *     itemOperations={
 *          "put",
 *          "delete",
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"pa","commands","crepe","ing"}
 *               }
 *          }
 *     },
 *     collectionOperations={
 *         "post",
 *     "get"={
 *              "normalization_context"={
 *                  "groups"={"pa","commands","crepe","ing"}
 *               }
 *          }
 *     }
 *     )
 */

class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"pa"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Crepe::class, inversedBy="paniers")
     * @Groups({"pa"})
     */
    private $crepes;

    /**
     * @ORM\OneToOne(targetEntity=Factures::class, inversedBy="panier", cascade={"persist", "remove"})
     * @Groups({"pa"})
     */
    private $facture;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"pa"})
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=CrepeCommande::class, mappedBy="Panier")
     */
    private $CrepeCommande;

    /**
     * @ORM\OneToMany(targetEntity=CrepeCommande::class, mappedBy="panier")
     * @Groups({"pa"})
     */
    private $commands;

    public function __construct()
    {
        $this->crepes = new ArrayCollection();
        $this->CrepeCommande = new ArrayCollection();
        $this->commands = new ArrayCollection();
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
    public function getCrepeCommande(): Collection
    {
        return $this->CrepeCommande;
    }

    public function addCrepeCommande(CrepeCommande $crepeCommande): self
    {
        if (!$this->CrepeCommande->contains($crepeCommande)) {
            $this->CrepeCommande[] = $crepeCommande;
            $crepeCommande->setPanier($this);
        }

        return $this;
    }

    public function removeCrepeCommande(CrepeCommande $crepeCommande): self
    {
        if ($this->CrepeCommande->removeElement($crepeCommande)) {
            // set the owning side to null (unless already changed)
            if ($crepeCommande->getPanier() === $this) {
                $crepeCommande->setPanier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CrepeCommande[]
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    public function addCommand(CrepeCommande $command): self
    {
        if (!$this->commands->contains($command)) {
            $this->commands[] = $command;
            $command->setPanier($this);
        }

        return $this;
    }

    public function removeCommand(CrepeCommande $command): self
    {
        if ($this->commands->removeElement($command)) {
            // set the owning side to null (unless already changed)
            if ($command->getPanier() === $this) {
                $command->setPanier(null);
            }
        }

        return $this;
    }
}
