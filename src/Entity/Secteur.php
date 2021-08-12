<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SecteurRepository::class)
 */
#[ApiResource(
    normalizationContext:(['groups' => ['read:secteur','read:secteur']]),
    denormalizationContext:(['groups' => 'write:secteur']),
    collectionOperations:['get','post'],
    itemOperations:['get']
)]
class Secteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer") 
     */
    #[Groups(['read:secteurs','read:secteur','write:secteur'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255) 
     * Assert\leng(min=8)
     */
    #[Groups(['read:secteurs','read:secteur','read:competence','read:competences','write:secteur'])]
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Competences::class, mappedBy="secteur")
     */
    #[Groups(['read:secteur','write:secteur'])]
    private $competences;
    
    public function __toString()
    {
        return(string) $this->nom;
    }


    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setSecteur($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getSecteur() === $this) {
                $competence->setSecteur(null);
            }
        }

        return $this;
    }
}
