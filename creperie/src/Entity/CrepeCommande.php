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
 *     itemOperations={
 *          "put",
 *          "delete",
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"commands","crepe","ing"}
 *               }
 *          }
 *     },
 *     collectionOperations={
 *         "post",
     *     "get"={
     *              "normalization_context"={
     *                  "groups"={"commands","crepe","ing"}
     *               }
     *          }
     *     }
 *     )
 */
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
     * @ORM\ManyToOne(targetEntity=Crepe::class)
     *
     * @Groups({"commands"})
     */
    private $crepe;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredients::class, inversedBy="crepeCommandes")
     *
     * @Groups({"commands"})
     */
    private $extra;


    public function __construct()
    {
        $this->extra = new ArrayCollection();
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
    public function getExtra(): Collection
    {
        return $this->extra;
    }

    public function addExtra(ingredients $extra): self
    {
        if (!$this->extra->contains($extra)) {
            $this->extra[] = $extra;
        }

        return $this;
    }

    public function removeExtra(ingredients $extra): self
    {
        $this->extra->removeElement($extra);

        return $this;
    }
}
