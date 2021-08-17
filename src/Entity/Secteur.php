<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SecteurRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=SecteurRepository::class)
 */
#[ApiResource(
                paginationItemsPerPage: 2,
                paginationMaximumItemsPerPage: 2,
    paginationClientItemsPerPage: true,
                collectionOperations:[
                    'get' => ['normalization_context'=> ['groups' => ['secteurs']]]],
                itemOperations:['get'=>['normalization_context' => ['groups'=>['secteur']]]],
                ),
                ApiFilter(SearchFilter::class, properties:['id' => 'exact', 'nom' => 'partial'])]              
class Secteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer") 
     */
    #[Groups(['secteurs','secteur'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255) 
     * Assert\leng(min=8)
     */
    #[Groups(['secteurs','secteur','read:competence','read:competences'])]
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Competences::class, mappedBy="secteur")
     */
    #[Groups(['secteur'])]
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
