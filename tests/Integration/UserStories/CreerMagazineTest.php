<?php

namespace Integration\UserStories;

use App\Entites\Adherent;
use App\Entites\Livre;
use App\Entites\Magazine;
use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerMagazine;
use App\UserStories\CreerLivre\CreerMagazineRequete;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerMagazineTest extends TestCase {
    protected EntityManagerInterface $entityManager;
    protected ValidatorInterface $validateur;

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
        $this->validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        // Création du schema de la base de données
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);
    }

    #[test]
    public function creerLivre_ValeursCorrectes_True() {
        // Arrange
        $requete = new CreerMagazineRequete("TitreMagazine",5,"15/11/2004");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validateur);

        // Act
        $resultat = $creerMagazine->execute($requete);

        // Assert
        $repository = $this->entityManager->getRepository(Magazine::class);
        $magazine = $repository->findOneBy(["titre" => "TitreMagazine" ]);
        $this->assertNotNull($magazine);
        $this->assertEquals("TitreMagazine",$magazine->getTitre());
    }
    #[test]
    public function creerLivre_FormatDateIncorrectes_Exception() {
        // Arrange
        $requete = new CreerMagazineRequete("TitreMagazine",5,"15/15/2004");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerMagazine->execute($requete);
    }
    #[test]
    public function creerLivre_TitreIncorrectes_Exception() {
        // Arrange
        $requete = new CreerMagazineRequete("",5,"15/12/2004");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerMagazine->execute($requete);
    }
    #[test]
    public function creerLivre_NuméroMagazinIncorrectes_Exception() {
        // Arrange
        $requete = new CreerMagazineRequete("TitreMagazine",-1,"15/12/2004");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerMagazine->execute($requete);
    }
    #[test]
    public function creerLivre_DatePublicationIncorrectes_Exception() {
        // Arrange
        $requete = new CreerMagazineRequete("TitreMagazine",15,"");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerMagazine->execute($requete);
    }
}
