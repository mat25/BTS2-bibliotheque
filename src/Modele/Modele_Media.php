<?php

namespace App\Modele;

use App\Entites\Media;
use Doctrine\ORM\EntityManagerInterface;

class Modele_Media {
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function ListerMediaParStatus(string $status) : Media {
        $qb = $this->entityManager->createQueryBuilder()
            ->from(Media::class,"m")
            ->where('m.status = :status')
            ->setParameter('status',$status)
            ->orderBy('m.date_creation','DESC');
        return $qb->getQuery()->getResult();
    }
}