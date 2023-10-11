<?php

namespace App\Entites;

class Adherent
{
    protected int $id;
    private string $numeroAdherent;
    private string $prenom;
    private string $nom;
    private string $email;
    private \DateTime $dateAdhesion;

    public function __construct()
    {

    }

}