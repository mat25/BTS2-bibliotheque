<?php

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerMagazineRequete;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;

require "./vendor/autoload.php";


$app = new \Silly\Application();

$app->command('CreerLivre', function (SymfonyStyle $io ) {
    require "bootstrap.php";
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $io->title("Création d'un livre");
    $titre = $io->ask("Veuillez saisir le titre du livre","");
    $auteur = $io->ask("Veuillez saisir l'auteur' du livre","");
    $isbn = $io->ask("Veuillez saisir l'isbn","");
    $nbPage = $io->ask("Veuillez saisir le nombre de page",0);

    $requete = new CreerMagazineRequete($titre,$isbn,$auteur,$nbPage);
    $creerLivre = new CreerLivre($entityManager,$validateur);

    try {
        $creerLivre->execute($requete);
        $io->writeln("Le Livre a bien été creer !");
    } catch (\Exception $e) {
        $io->error($e->getMessage());
    }
});

$app->run();
