<?php

namespace App\Entites;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class BluRay extends Media
{
    #[Column(name: 'realisateur',length: 20)]
    protected string $realisateur;
    #[Column(name: 'duree', type: 'float')]
    protected float $duree;
    #[Column(name:'annee_de_sortie',length: 50)]
    protected string $anneeSortie;

    public function __construct() {

    }
    public function setDureeEmprunt(): void
    {
        $this->dureeEmprunt = 15;
    }

    public function getType()
    {
        return "bluray";
    }
}