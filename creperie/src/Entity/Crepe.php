<?php

namespace App\Entity;


use App\Repository\CrepeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CrepeRepository::class)
 *
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     paginationEnabled=false,
 *     normalizationContext={"groups"={"crepe"}},
 * )
 */
class Crepe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"crepe"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"crepe"})
     */
    private $img;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"crepe"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredients::class, inversedBy="Crepes")
     *
     * @Groups({"crepe"})
     */
    private $ingredients;

    /**
     * @ORM\ManyToMany(targetEntity=Factures::class, mappedBy="Crepes")
     */
    private $factures;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     *  @Groups({"crepe"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Panier::class, mappedBy="crepes")
     */
    private $paniers;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
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
     * @return Collection|ingredients[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(ingredients $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(ingredients $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection|Factures[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Factures $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->addCrepe($this);
        }

        return $this;
    }

    public function removeFacture(Factures $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            $facture->removeCrepe($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Panier[]
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->addCrepe($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            $panier->removeCrepe($this);
        }

        return $this;
    }


}
