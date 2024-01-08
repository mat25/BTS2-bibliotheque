<?php


namespace App\UserStories\EmprunterUnMedia;


use Symfony\Component\Validator\Constraints as Assert;

class EmprunterUnMediaRequete
{
    #[Assert\NotBlank (
        message: "L'id est obligatoire"
    )]
    #[Assert\Positive(
        message: "l'id doit être positif"
    )]
    public string $id;
    #[Assert\NotBlank (
        message: "Le numéro d'adhérent de l'emprunteur est obligatoire"
    )]
    public string $numAdherent;


    public function __construct($id, $numAdherent)
    {
        $this->id = $id;
        $this->numAdherent = $numAdherent;
    }


}