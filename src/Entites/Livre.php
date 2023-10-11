<?php

namespace App\Entites;

class Livre extends Media
{
    protected int $id;
    protected string $isbn;
    protected string $auteur;
    protected int $nbrPage;

    public function __construct() {

    }
}