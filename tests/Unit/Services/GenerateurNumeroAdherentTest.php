<?php

namespace Unit\Services;

use App\Services\GenerateurNumeroAdherent;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GenerateurNumeroAdherentTest extends TestCase
{
    #[test]
    public function GenerateurNumeroAdherent_Longueur_9 () {
        $numero = (new GenerateurNumeroAdherent())->generer();
        $this->assertEquals(9,strlen($numero));
    }
    #[test]
    public function GenerateurNumeroAdherent_Debut_AD () {
        $numero = (new GenerateurNumeroAdherent())->generer();
        $this->assertEquals("AD-",substr($numero,0,3));
    }
}