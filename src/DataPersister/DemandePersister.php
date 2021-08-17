<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Demande;
use Doctrine\ORM\EntityManagerInterface;

class DemandePersister implements DataPersisterInterface
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em; 
    }

    public function supports($data): bool
    {
        return $data instanceof Demande;
    }

    
    public function persist($data)
    {
        $data->setdate(new \DateTime());

        $this->em->persist($data);
        $this->em->flush();
        
    }

    public function remove($data)
    {       
        $this->em->remove($data);
        $this->em->flush();
    }

}