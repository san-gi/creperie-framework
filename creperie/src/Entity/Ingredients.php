<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientsRepository::class)
 *
 *  @ApiResource(
 *     paginationEnabled=false,
 *     normalizationContext={"groups"={"ingredients"}},
 *     )
 *
 */
class Ingredients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"ingredients"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"ingredients"})
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     *
     * @Groups({"ingredients"})
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Crepe::class, mappedBy="Ingredients")
     *
     */
    private $crepes;

    /**
     * @ORM\ManyToMany(targetEntity=Crepe::class, mappedBy="extendIngredients")
     */
    private $CrepesExtend;

    /**
     * @ORM\ManyToMany(targetEntity=CrepeCommande::class, mappedBy="relation")
     */
    private $crepeCommandes;

    public function __construct()
    {
        $this->crepes = new ArrayCollection();
        $this->CrepesExtend = new ArrayCollection();
        $this->crepeCommandes = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
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
            $crepe->addIngredient($this);
        }

        return $this;
    }

    public function removeCrepe(Crepe $crepe): self
    {
        if ($this->crepes->removeElement($crepe)) {
            $crepe->removeIngredient($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection|Crepe[]
     */
    public function getCrepesExtend(): Collection
    {
        return $this->CrepesExtend;
    }

    public function addCrepesExtend(Crepe $crepesExtend): self
    {
        if (!$this->CrepesExtend->contains($crepesExtend)) {
            $this->CrepesExtend[] = $crepesExtend;
            $crepesExtend->addExtendIngredient($this);
        }

        return $this;
    }

    public function removeCrepesExtend(Crepe $crepesExtend): self
    {
        if ($this->CrepesExtend->removeElement($crepesExtend)) {
            $crepesExtend->removeExtendIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection|CrepeCommande[]
     */
    public function getCrepeCommandes(): Collection
    {
        return $this->crepeCommandes;
    }

    public function addCrepeCommande(CrepeCommande $crepeCommande): self
    {
        if (!$this->crepeCommandes->contains($crepeCommande)) {
            $this->crepeCommandes[] = $crepeCommande;
            $crepeCommande->addRelation($this);
        }

        return $this;
    }

    public function removeCrepeCommande(CrepeCommande $crepeCommande): self
    {
        if ($this->crepeCommandes->removeElement($crepeCommande)) {
            $crepeCommande->removeRelation($this);
        }

        return $this;
    }
}
