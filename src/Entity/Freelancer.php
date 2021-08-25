<?php

namespace App\Entity;

class Freelancer
{   
    /**
     * @var string
     */
    private $competences;

    /**
     * @var string
     */
    private $adresse;

    /**
     * Get the value of competences
     */ 
    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    /**
     * Set the value of competences
     *
     * @return  self
     */ 
    public function setCompetences($competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}