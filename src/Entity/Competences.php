<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetencesRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 */
#[ApiResource(
    paginationItemsPerPage: 2,
    paginationMaximumItemsPerPage: 2,
    paginationClientItemsPerPage: true,
    collectionOperations:['post' => [
        'denormalization_context' => ['groups' => 'write:competence']
                        ],
        'get'=>[
            'normalization_context' => ['groups' => 'read:competences']]                           
                ],
    itemOperations:['put'=> ['denormalization_context' => ['groups' => 'write:competence']],
    'patch'=> ['denormalization_context' => ['groups' => 'write:competence']],
    'delete' => ['denormalization_context' => ['groups' => 'write:competence']],
        'get' => ['normalization_context' => ['groups' => 'read:competence']]
            ],
        ),
        ApiFilter(SearchFilter::class, properties:['id' => 'exact', 'specialite' => 'partial'])]
class Competences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:competences','read:competence','read:user','write:competence'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:competences','read:competence','read:user','read:secteur','write:competence'])]
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
    #[Groups(['read:competence','read:user','write:competence'])]
    private $secteur;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="profil")
     */
    private $utilisateur;

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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

}
