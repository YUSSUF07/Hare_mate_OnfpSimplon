<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetencesRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 */
#[ApiResource(
    normalizationContext:(['groups' => 'read:competences']),
    denormalizationContext:(['groups' => 'write:competence']),
    collectionOperations:(['get'=> ['groups' => 'read:competences']]),
    itemOperations:['put' => ['groups' => 'write:competence'],
                    'delete',
                    'get' => ['normalization_context' => ['groups' => 'read:competence']]
                    ]
)]
class Competences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:competences','read:competence','read:user'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:competences','read:competence','read:user','write:competence','read:secteur'])]
    private $specialite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:competence','read:user','write:competence'])]
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    
    #[Groups(['read:competence','read:user','write:competence'])]
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="competences")
     */
    #[Groups(['read:competence','read:competences','read:user'])]
    private $secteur;

    public function __toString()
    {
        return(string) $this->nom;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

}
