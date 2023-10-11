<?php

namespace App;

class Emprunt
{
    protected int $id;
    private \DateTime $dateEmprunt;
    private \DateTime $dateRetourEstime;

    private ?\DateTime $dateRetour ;
    private Adherent $adherent;
    private Media $media;

    public function __construct()
    {

    }
}