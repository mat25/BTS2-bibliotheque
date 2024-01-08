<?php

namespace App\Entites;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity]
class Emprunt
{
    #[Id]
    #[Column(name: 'id_emprunt',type: 'integer')]
    #[GeneratedValue]
    protected int $id;
    #[Column(type: 'datetime')]
    private \DateTime $dateEmprunt;
    #[Column(type: 'datetime')]
    private \DateTime $dateRetourEstime;
    #[Column(type: 'datetime',nullable: True)]

    private ?\DateTime $dateRetour ;
    #[ManyToOne(targetEntity: Adherent::class)]
    #[JoinColumn(name: 'id_adherent', referencedColumnName: 'id_adherent')]
    private Adherent $adherent;
    #[OneToOne(targetEntity: Media::class)]
    #[JoinColumn(name: 'id_media', referencedColumnName: 'id_media')]
    private Media $media;

    public function __construct()
    {
        $this->dateRetour=null;
    }


    public function empruntEnCours() : bool {
         return $this->dateRetour == null;
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
    public function setDateEmprunt(): void
    {
        $this->dateEmprunt = new \DateTime();
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
    public function setDateRetourEstime(): void
    {
        $this->dateRetourEstime = (new \DateTime())->modify("+".$this->media->getDureeEmprunt()." days");
    }



}