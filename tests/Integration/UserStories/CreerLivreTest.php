<?php

namespace Tests\Integration\UserStories;

use App\Entites\Adherent;
use App\Entites\Livre;
use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerLivreTest extends TestCase {
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
        $requete = new CreerLivreRequete("stick","18754fzjgzu","michel Sardou",150,"15/11/1988");
        $creerLivre = new CreerLivre($this->entityManager,$this->validateur);

        // Act
        $resultat = $creerLivre->execute($requete);

        // Assert
        $repository = $this->entityManager->getRepository(Livre::class);
        $livre = $repository->findOneBy(["isbn" => "18754fzjgzu" ]);
        $this->assertNotNull($livre);
        $this->assertEquals("michel Sardou",$livre->getAuteur());
    }
    #[test]
    public function creerLivre_TitreIncorrectes_Exception() {
        // Arrange
        $requete = new CreerLivreRequete("","18754fzjgzu","michel Sardou",150,"15/11/1988");
        $creerLivre = new CreerLivre($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerLivre->execute($requete);
    }

    #[test]
    public function creerLivre_IsbnDejaRenseigner_Exception() {
        // Arrange
        $requete = new CreerLivreRequete("test","18754fzjgzu","michel Sardou",150,"15/11/1988");
        $creerLivre = new CreerLivre($this->entityManager,$this->validateur);
        $creerLivre->execute($requete);

        $this->expectException(\Exception::class);
        $creerLivre->execute($requete);
    }

    #[test]
    public function creerLivre_isbnIncorrectes_Exception() {
        // Arrange
        $requete = new CreerLivreRequete("test","","michel Sardou",150,"15/11/1988");
        $creerLivre = new CreerLivre($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerLivre->execute($requete);
    }
    #[test]
    public function creerLivre_auteurIncorrectes_Exception() {
        // Arrange
        $requete = new CreerLivreRequete("test","18754fzjgzu","",150,"15/11/1988");
        $creerLivre = new CreerLivre($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerLivre->execute($requete);
    }
    #[test]
    public function creerLivre_nbPagesIncorrectes_Exception() {
        // Arrange
        $requete = new CreerLivreRequete("test","18754fzjgzu","michel Sardou",0,"15/11/1988");
        $creerLivre = new CreerLivre($this->entityManager,$this->validateur);

        $this->expectException(\Exception::class);
        $creerLivre->execute($requete);
    }

}
