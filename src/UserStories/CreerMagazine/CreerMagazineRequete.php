<?php

namespace App\UserStories\CreerMagazine;

use Symfony\Component\Validator\Constraints as Assert;

class CreerMagazineRequete
{
    #[Assert\NotBlank (
        message: "Le titre est obligatoire"
    )]
    public string $titre ;
    #[Assert\NotBlank (
        message: "Le numero de magazine est obligatoire"
    )]
    public int $numeroMagazine ;
    #[Assert\NotBlank (
        message: "La date publication est obligatoire"
    )]
    public string $datePublication ;




    public function __construct($titre, $numeroMagazine, $datePublication)
    {
        $this->titre = $titre;
        $this->numeroMagazine = $numeroMagazine;
        $this->datePublication = $datePublication;
    }


}