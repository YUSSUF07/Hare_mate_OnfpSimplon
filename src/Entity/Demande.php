<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DemandeRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 */
#[ApiResource(  normalizationContext:(['groups' => 'read:demande'])
, itemOperations:['get' => ['normalization_context' => ['groups' => 'read:demande']] ]
)]
class Demande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    #[Groups(['read:demande','read:user'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:demande','read:user'])]
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:demande','read:user'])]
    private $tarif;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(['read:demande'])]
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="demandes")
     */
    #[Groups(['read:demande'])]
    private $user;
    
    public function __toString()
    {
        return(string) $this->id;
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }
}
