<?php

namespace App\Entity;

use App\Repository\TypeChabreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeChabreRepository::class)
 */
class TypeChabre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="type")
     */
    private $chambres;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }


  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

   
  public function __toString()
  {
      return $this->type;
  }

  /**
   * @return Collection|Chambre[]
   */
  public function getChambres(): Collection
  {
      return $this->chambres;
  }

  public function addChambre(Chambre $chambre): self
  {
      if (!$this->chambres->contains($chambre)) {
          $this->chambres[] = $chambre;
          $chambre->setType($this);
      }

      return $this;
  }

  public function removeChambre(Chambre $chambre): self
  {
      if ($this->chambres->removeElement($chambre)) {
          // set the owning side to null (unless already changed)
          if ($chambre->getType() === $this) {
              $chambre->setType(null);
          }
      }

      return $this;
  }
    
}
