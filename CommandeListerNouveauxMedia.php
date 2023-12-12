<?php
namespace App;

use App\UserStorie\ListerNouveauxMedia\ListerNouveauxMedia;
use Symfony\Component\Console\Style\SymfonyStyle;

require "./vendor/autoload.php";


$app = new \Silly\Application();

$app->command('ListerNouveauxMedia', function (SymfonyStyle $io ) {
    require "bootstrap.php";
    $test = new ListerNouveauxMedia();
    dump($test->execute());
});

$app->run();
