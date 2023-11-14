<?php

namespace App\Entites;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;


#[Entity]
#[InheritanceType("JOINED")]
#[DiscriminatorColumn(name: "type", type: "string")]
#[DiscriminatorMap(["Livre" => "Livre", "Magazine" => "Magazine","BluRay" => "BluRay"])]
abstract class Media
{
    #[Id]
    #[Column(name: 'id_media',type: 'integer')]
    #[GeneratedValue]
    protected int $id;
    #[Column(name: 'titre_media',length: 20)]
    protected string $titre;
    #[Column(name: 'status',length: 10)]
    protected string $status;
    #[Column(name: 'date_creation', type: 'datetime')]
    protected \DateTime $dateCreation;
    #[Column(name: 'duree_emprunt',type: 'integer')]
    protected int $dureeEmprunt;

    public function __construct() {

    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation(string $dateCreation): void
    {
        $this->dateCreation = \DateTime::createFromFormat("d/m/Y",$dateCreation);
    }

    /**
     * @param int $dureeEmprunt
     */
    public function setDureeEmprunt(): void
    {
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @return int
     */
    public function getDureeEmprunt(): int
    {
        return $this->dureeEmprunt;
    }




}