<?php

namespace App\UserStorie\ListerNouveauxMedia;

require "./vendor/autoload.php";

use App\Entites\Media;
use App\Entites\StatusMedia;
use App\Modele\Modele_Media;
use Doctrine\ORM\EntityManagerInterface;

class ListerNouveauxMedia
{

    public function execute() :  Media {

        // Lister les nouveaux Média
        $modeleMedia = new Modele_Media($entityManager);
        $medias = $modeleMedia->ListerMediaParStatus(StatusMedia::NEW);
        return $medias;
    }
}