<?php

namespace Tests\Integration\UserStories;

use App\Entites\Adherent;
use App\Services\GenerateurNumeroAdherent;
use App\UserStories\CreerAdherent\CreerAdherent;
use App\UserStories\CreerAdherent\CreerAdherentRequete;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class CreerAdherentTest extends TestCase
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

    /**
     * @throws NotSupported
     */
    #[test]
    public function creerAdherent_ValeursCorrectes_True() {
        // Arrange
        $requete = new CreerAdherentRequete("Matéo","JEAN","mateoj@gmail.com");
        $creerAdherents = new CreerAdherent($this->entityManager,$this->generateur,$this->validateur);

        // Act
        $resultat = $creerAdherents->execute($requete);

        // Assert
        $repository = $this->entityManager->getRepository(Adherent::class);
        $adherent = $repository->findOneBy(["email" => "mateoj@gmail.com" ]);
        $this->assertNotNull($adherent);
        $this->assertEquals("Matéo",$adherent->getPrenom());
    }

    #[test]
    public function creerAdherent_ValeursIncorrectes_Exception() {
        // Arrange
        $requete = new CreerAdherentRequete("","","");
        $creerAdherents = new CreerAdherent($this->entityManager,$this->generateur,$this->validateur);

        //
        $this->expectException(\Exception::class);

        $creerAdherents->execute($requete);
    }

    /**
     * @throws NotSupported
     */
    #[test]
    public function creerAdherent_NomIncorrectes_Exception() {
        // Arrange
        $requete = new CreerAdherentRequete("Matéo","","mateoj@gmail.com");
        $creerAdherents = new CreerAdherent($this->entityManager,$this->generateur,$this->validateur);

        //
        $this->expectException(\Exception::class);

        $creerAdherents->execute($requete);
    }

    /**
     * @throws NotSupported
     */
    #[test]
    public function creerAdherent_PrenomIncorrectes_Exception() {
        // Arrange
        $requete = new CreerAdherentRequete("","JEAN","mateoj@gmail.com");
        $creerAdherents = new CreerAdherent($this->entityManager,$this->generateur,$this->validateur);

        //
        $this->expectException(\Exception::class);

        $creerAdherents->execute($requete);
    }

    /**
     * @throws NotSupported
     */
    #[test]
    public function creerAdherent_EmailIncorrectes_Exception() {
        // Arrange
        $requete = new CreerAdherentRequete("Matéo","JEAN","mateojgmail.com");
        $creerAdherents = new CreerAdherent($this->entityManager,$this->generateur,$this->validateur);

        //
        $this->expectException(\Exception::class);

        $creerAdherents->execute($requete);
    }

    /**
     * @throws NotSupported
     */
    #[test]
    public function creerAdherent_EmailExisteDeja_Exception() {
        // Arrange
        $requete = new CreerAdherentRequete("Matéo","JEAN","mateoj@gmail.com");
        $creerAdherents = new CreerAdherent($this->entityManager,$this->generateur,$this->validateur);
        $creerAdherents->execute($requete);
        //
        $this->expectException(\Exception::class);

        $creerAdherents->execute($requete);
    }
}