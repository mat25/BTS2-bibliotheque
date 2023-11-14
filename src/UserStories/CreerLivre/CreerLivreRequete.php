<?php

namespace App\UserStories\CreerLivre;

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
    public string $isbn ;
    #[Assert\NotBlank (
        message: "L'auteur est obligatoire"
    )]
    public string $auteur ;
    #[Assert\NotBlank (
        message: "Le nombre de page est obligatoire"
    )]
    public int $nbrPages ;
    #[Assert\NotBlank (
        message: "La date de parution est obligatoire"
    )]
    public string $dateParution ;

    /**
     * @param string $titre
     * @param string $isbn
     * @param string $auteur
     * @param int $nbrPages
     * @param string $dateParution
     */
    public function __construct(string $titre, string $isbn, string $auteur, int $nbrPages, string $dateParution)
    {
        $this->titre = $titre;
        $this->isbn = $isbn;
        $this->auteur = $auteur;
        $this->nbrPages = $nbrPages;
        $this->dateParution = $dateParution;
    }


}