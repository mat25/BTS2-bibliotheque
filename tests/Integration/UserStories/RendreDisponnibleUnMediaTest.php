<?php
//
//namespace Tests\Integration\UserStories;
//
//use App\Entites\Adherent;
//use App\Services\GenerateurNumeroAdherent;
//use App\UserStories\CreerMagazine\CreerMagazine;
//use App\UserStories\CreerMagazine\CreerMagazineRequete;
//use App\UserStories\ListerNouveauxMedia\ListerNouveauxMedia;
//use App\UserStories\RendreDisponibleUnMedia\RendreDisponibleUnMedia;
//use App\UserStories\RendreDisponibleUnMedia\RendreDisponibleUnMediaRequete;
//use Doctrine\DBAL\DriverManager;
//use Doctrine\ORM\EntityManager;
//use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\ORM\ORMSetup;
//use Doctrine\ORM\Tools\SchemaTool;
//use PHPUnit\Framework\Attributes\Test;
//use PHPUnit\Framework\TestCase;
//use Symfony\Component\Validator\Validation;
//use Symfony\Component\Validator\Validator\ValidatorInterface;
//
//class RendreDisponnibleUnMediaTest extends TestCase
//{
//    protected EntityManagerInterface $entityManager;
//    protected GenerateurNumeroAdherent $generateur;
//    protected ValidatorInterface $validateur;
//
//    // Cette methode va etre executer avant chaque test
//    protected function setUp() : void
//    {
//        echo "setup ---------------------------------------------------------";
//        // Configuration de Doctrine pour les tests
//        $config = ORMSetup::createAttributeMetadataConfiguration(
//            [__DIR__.'/../../../src/'],
//            true
//        );
//
//        // Configuration de la connexion à la base de données
//        // Utilisation d'une base de données SQLite en mémoire
//        $connection = DriverManager::getConnection([
//            'driver' => 'pdo_sqlite',
//            'path' => ':memory:'
//        ], $config);
//
//        // Création des dépendances
//        $this->entityManager = new EntityManager($connection, $config);
//        $this->generateur = new GenerateurNumeroAdherent();
//        $this->validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
//
//        // Création du schema de la base de données
//        $schemaTool = new SchemaTool($this->entityManager);
//        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
//        $schemaTool->createSchema($metadata);
//    }
//
//
////    #[test]
////    public function rendreDisponnibleUnMedia_ValeursVide_Exception() {
////        $requete = new RendreDisponibleUnMediaRequete("");
////        $resultat = new RendreDisponibleUnMedia($this->entityManager,$this->validateur);
////
////        $resultat->execute($requete);
////
////        $this->expectException(\Exception::class);
////    }
//
//
//}

