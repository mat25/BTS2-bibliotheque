<?php

namespace App\tests;

use App\Emprunt;
use PHPUnit\Framework\TestCase;

class EmpruntTest extends TestCase
{
    /**
     * @test
     */
    public function EmpruntEnCours_SiEmpruntPasRendu_True() {
        $emprunt = new Emprunt();
        $emprunt->setDateEmprunt((new \DateTime())->modify("-30 days"));
        $this->assertEquals($emprunt->empruntEnCours(),true);
    }
    /**
     * @test
     */
    public function EmpruntEnCours_SiEmpruntRendu_False() {
        $emprunt = new Emprunt();
        $emprunt->setDateEmprunt((new \DateTime())->modify("-30 days"));
        $emprunt->setDateRetour(new \DateTime());
        $this->assertEquals($emprunt->empruntEnCours(),false);
    }

    /**
     * @test
     */
    public function EmpruntEnAlerte_SiDateRetourEstimeEstDepasser_True() {
        $emprunt = new Emprunt();
        $emprunt->setDateEmprunt((new \DateTime())->modify("-30 days"));
        $emprunt->setDateRetourEstime((new \DateTime())->modify("-10 days"));
        $this->assertEquals($emprunt->empruntEnRetard(),true);
    }


    /**
     * @test
     */
    public function EmpruntEnAlerte_SiDateRetourEstimeEstPasDepasser_False() {
        $emprunt = new Emprunt();
        $emprunt->setDateEmprunt((new \DateTime())->modify("-30 days"));
        $emprunt->setDateRetourEstime((new \DateTime())->modify("+10 days"));
        $this->assertEquals($emprunt->empruntEnRetard(),false);
    }

}