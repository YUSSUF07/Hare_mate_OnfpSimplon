<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Demande;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DemandePersister implements DataPersisterInterface
{
    private EntityManagerInterface $em;
public function __construct(EntityManagerInterface $em)
{
    $this->em=$em;
}

 public function supports($data): bool
 {
   return $data instanceof Demande;  
 }   

 public function persist($data)
 {
    $data ->setCreatedAt(new \DateTime());
    $this->em->persist($data);
    $this->em->flush(); 
 }

public function remove($data)
{
    $this->em->remove($data);
    $this->em->flush();
}
 
}