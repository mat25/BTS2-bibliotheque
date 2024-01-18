<?php

namespace Tests\Integration\UserStories;

use App\Entites\Adherent;
use App\Services\GenerateurNumeroAdherent;
use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use App\UserStories\ListerNouveauxMedia\ListerNouveauxMedia;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ListerNouveauxMediaTest extends TestCase
{
    protected EntityManagerInterface $entityManager;
    protected GenerateurNumeroAdherent $generateur;
    protected ValidatorInterface $validateur;

    // Cette methode va etre executer avant chaque test
    protected function setUp() : void
    {
        echo "setup ---------------------------------------------------------";
        // Configuration de Doctrine pour les tests
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__.'/../../../src/'],
            true
        );

        // Configuration de la connexion à la base de données
        // Utilisation d'une base de données SQLite en mémoire
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => ':memory:'
        ], $config);

        // Création des dépendances
        $this->entityManager = new EntityManager($connection, $config);
        $this->generateur = new GenerateurNumeroAdherent();
        $this->validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        // Création du schema de la base de données
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);
    }


    #[test]
    public function listerNouveauxMedia_AucunMedia_array() {
        $medias = new ListerNouveauxMedia($this->entityManager);

        $resultat = $medias->execute();

       $this->assertIsArray($resultat);
       $this->assertEmpty($resultat);
    }

    #[test]
    public function listerNouveauxMedia_PlusieursMedias_array() {
        $requete = new CreerMagazineRequete("TitreMagazine",5,"15/11/2004");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validateur);

        $creerMagazine->execute($requete);

        $medias = new ListerNouveauxMedia($this->entityManager);
        $resultat = $medias->execute();

        $this->assertIsArray($resultat);
        $this->assertNotEmpty($resultat);
    }


}
