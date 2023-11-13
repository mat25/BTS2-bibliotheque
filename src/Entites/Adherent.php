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
    public function setNumeroAdherent(string $numero): void
    {
        $this->numeroAdherent = $numero;
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


    public function setDateAdhesion(\DateTime $dateAdhesion): void
    {
        $this->dateAdhesion = $dateAdhesion;
    }

    /**
     * @return string
     */
    public function getNumeroAdherent(): string
    {
        return $this->numeroAdherent;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdhesion(): \DateTime
    {
        return $this->dateAdhesion;
    }



}