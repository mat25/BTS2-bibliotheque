<?php

namespace App\UserStories\ListerNouveauxMedia;

require "./vendor/autoload.php";


use App\Entites\Media;
use App\Entites\StatusMedia;
use Doctrine\ORM\EntityManagerInterface;

class ListerNouveauxMedia
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute() :  array {
        $repository = $this->entityManager->getRepository(Media::class);
        $mediaRepository = $repository->findBy(["status" => StatusMedia::NEW]);
        $medias = [];
        foreach($mediaRepository as $media){
            $medias[] = ["id" => $media->getId(), "titre" => $media->getTitre(), "status" => $media->getStatus(), "dateCreation" => $media->getDateCreation(), "type" => $media->getType()];
        }

        arsort($medias);

        return $medias;
    }
}