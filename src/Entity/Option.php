<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`option`")
 */
class Option
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Owners::class, inversedBy="options")
     */
    private  $propreties;

    public function __construct()
    {
        $this->propreties = new ArrayCollection();
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
     * @return Collection<int, Owners>
     */
    public function getPropreties(): Collection
    {
        return $this->propreties;
    }

    public function addProprety(Owners $proprety): self
    {
        if (!$this->propreties->contains($proprety)) {
            $this->propreties[] = $proprety;
        }

        return $this;
    }

    public function removeProprety(Owners $proprety): self
    {
        $this->propreties->removeElement($proprety);

        return $this;
    }
}
