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
        $this->dateRetour=null;
    }


    public function empruntEnCours() : bool {
        if ($this->dateRetour == null) {
            return true;
        }
        return false;
    }

    public function empruntEnRetard() :bool {
        $dateJour = new \DateTime();
        if ($this->empruntEnCours() && $this->dateRetourEstime->diff($dateJour)->invert == 0)  {
            return true;
        }
        return false;
    }

    /**
     * @param \DateTime $dateEmprunt
     */
    public function setDateEmprunt(\DateTime $dateEmprunt): void
    {
        $this->dateEmprunt = $dateEmprunt;
    }

    /**
     * @param \DateTime|null $dateRetour
     */
    public function setDateRetour(?\DateTime $dateRetour): void
    {
        $this->dateRetour = $dateRetour;
    }

    /**
     * @param Adherent $adherent
     */
    public function setAdherent(Adherent $adherent): void
    {
        $this->adherent = $adherent;
    }

    /**
     * @param Media $media
     */
    public function setMedia(Media $media): void
    {
        $this->media = $media;
    }

    /**
     * @param \DateTime $dateRetourEstime
     */
    public function setDateRetourEstime(\DateTime $dateRetourEstime): void
    {
        $this->dateRetourEstime = $dateRetourEstime;
    }



}