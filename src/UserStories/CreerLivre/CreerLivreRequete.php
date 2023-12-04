<?php

namespace App\UserStories\CreerLivre;

use http\Message;
use Symfony\Component\Validator\Constraints as Assert;

class CreerLivreRequete
{
    #[Assert\NotBlank (
        message: "Le titre est obligatoire"
    )]
    public string $titre ;
    #[Assert\NotBlank (
        message: "L'ISBN est obligatoire"
    )]
    #[Assert\Isbn(
        message:"l'isbn est invalide"
    )]
    public string $isbn ;
    #[Assert\NotBlank (
        message: "L'auteur est obligatoire"
    )]
    public string $auteur ;
    #[Assert\NotBlank (
        message: "Le nombre de page est obligatoire"
    )]
    public int $nbrPages ;



    public function __construct($titre, $isbn, $auteur, $nbrPages)
    {
        $this->titre = $titre;
        $this->isbn = $isbn;
        $this->auteur = $auteur;
        $this->nbrPages = $nbrPages;
    }


}