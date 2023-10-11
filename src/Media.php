<?php

namespace App;

abstract class Media
{
    protected int $id;
    protected string $titre;
    protected string $status;
    protected \DateTime $dateCreation;
    protected int $dureeEmprunt;

    public function __construct() {

    }
}