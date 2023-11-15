<?php

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;

require "./vendor/autoload.php";


$app = new \Silly\Application();

$app->command('CreerMagazine', function (SymfonyStyle $io ) {
    require "bootstrap.php";
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $io->title("Création d'un Magazine");
    $numeroMagazine = $io->ask("Veuillez saisir le numéro de magazine",0);
    $titre = $io->ask("Veuillez saisir le titre du Magazine","");
    $datePublication = $io->ask("Veuillez saisir la date de publication du Magazine","");


    $requete = new CreerMagazineRequete($titre,$numeroMagazine,$datePublication);
    $creerMagazine = new CreerMagazine($entityManager,$validateur);

    try {
        $creerMagazine->execute($requete);
        $io->writeln("Le Magazine a bien été creer !");
    } catch (\Exception $e) {
        $io->error($e->getMessage());
    }
});

$app->run();
