<?php

namespace App\Entity;

use App\Repository\CelebrityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CelebrityRepository::class)
 */
class Celebrity
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(name="type", type="string")
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bio;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Representative", inversedBy="celebrities")
     */
    private $representatives;

    public function __construct()
    {
        $this->representatives = new ArrayCollection();
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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepresentatives()
    {
        return $this->representatives;
    }

    /**
     * @param mixed $representatives
     */
    public function setRepresentatives($representatives)
    {
        $this->representatives = $representatives;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function addRepresentative(Representative $representative): self
    {
        if (!$this->representatives->contains($representative)) {
            $this->representatives[] = $representative;
        }

        return $this;
    }

    public function removeRepresentative(Representative $representative): self
    {
        $this->representatives->removeElement($representative);

        return $this;
    }

}
