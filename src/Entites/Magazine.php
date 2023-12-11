<?php

namespace App\Entites;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;


#[Entity]
class Magazine extends Media
{
    #[Column(name: 'numero_magazine',type: 'integer')]
    protected int $numeroMagazine;
    #[Column(name: 'date_publication', type: 'string')]
    protected string $datePublication;

    public function __construct() {

    }

    /**
     * @param int $numeroMagazine
     */
    public function setNumeroMagazine(int $numeroMagazine): void
    {
        $this->numeroMagazine = $numeroMagazine;
    }

    /**
     * @param string $datePublication
     */
    public function setDatePublication(string $datePublication): void
    {
        $this->datePublication = (\DateTime::createFromFormat("d/m/Y",$datePublication))->format("Y-m-d");
    }

    public function setDureeEmprunt(): void
    {
        $this->dureeEmprunt = 10;
    }
}