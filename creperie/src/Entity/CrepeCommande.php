<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CrepeCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CrepeCommandeRepository::class)
 *
 * @ApiResource(
 *     paginationEnabled=false,
 *     normalizationContext={"groups"={"commands"}},
 *     )
 */
#[ApiResource]
class CrepeCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"commands"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Crepe::class, inversedBy="Extra")
     */
    private $crepe;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredients::class, inversedBy="crepeCommandes")
     */
    private $relation;



    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrepe(): ?crepe
    {
        return $this->crepe;
    }

    public function setCrepe(?crepe $crepe): self
    {
        $this->crepe = $crepe;

        return $this;
    }

    /**
     * @return Collection|ingredients[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(ingredients $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
        }

        return $this;
    }

    public function removeRelation(ingredients $relation): self
    {
        $this->relation->removeElement($relation);

        return $this;
    }
}
