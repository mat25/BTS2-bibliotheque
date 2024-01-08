<?php

namespace App\Entites;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Livre extends Media
{
    #[Column(name: 'isbn',length: 40)]
    protected string $isbn;
    #[Column(name: 'auteur',length: 20)]
    protected string $auteur;
    #[Column(name: 'nbr_page',type: 'integer')]
    protected int $nbrPage;

    public function __construct() {

    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * @param int $nbrPage
     */
    public function setNbrPage(int $nbrPage): void
    {
        $this->nbrPage = $nbrPage;
    }

    public function setDureeEmprunt(): void
    {
        $this->dureeEmprunt = 21;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @return string
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * @return int
     */
    public function getNbrPage(): int
    {
        return $this->nbrPage;
    }

    public function getType()
    {
        return "livre";
    }

}

