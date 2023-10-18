<?php

namespace App\Entites;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'adherent')]
class Adherent
{
    #[Id]
    #[Column(name: 'id_adherent',type: 'integer')]
    #[GeneratedValue]
    protected int $id;
    #[Column(name: 'numero_adherent',length: 10)]
    private string $numeroAdherent;
    #[Column(name:'prenom_adherent',length: 50)]
    private string $prenom;
    #[Column(name: 'nom_adherent',length: 50)]
    private string $nom;
    #[Column(name: 'email_adherent',length: 100)]
    private string $email;
    #[Column(name: 'date_adhesion', type: 'datetime')]
    private \DateTime $dateAdhesion;

    public function __construct()
    {

    }

    /**
     * @param string $numeroAdherent
     */
    public function setNumeroAdherent(): void
    {
        $this->numeroAdherent = "AD-".random_int(100000,999999);
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function setDateAdhesion(string $dateAdhesion): void
    {
        $this->dateAdhesion = \DateTime::createFromFormat("d/m/Y",$dateAdhesion);
    }


}