<?php
namespace App;


use App\UserStories\ListerNouveauxMedia\ListerNouveauxMedia;
use Symfony\Component\Console\Style\SymfonyStyle;

require "./vendor/autoload.php";


$app = new \Silly\Application();

$app->command('ListerNouveauxMedia', function (SymfonyStyle $io ) {
    require "bootstrap.php";
    $listerMedia = new ListerNouveauxMedia($entityManager);
    $medias = $listerMedia->execute();
    $table = $io->createTable();
    $table->setHeaderTitle("Liste des nouveaux médias");
<<<<<<< HEAD
    $table->setHeaders(['id', 'titre', 'status', 'date de création', 'type']);
=======
    $table->setHeaders(['id', 'titre', 'statut', 'dateCreation', 'type']);
>>>>>>> 6d48607 (test)
    $table->setRows($medias);
    $table->render();
});

$app->run();
