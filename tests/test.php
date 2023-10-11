<?php


require "vendor/autoload.php";



$emprunt = new App\Emprunt();
$emprunt->setDateEmprunt((new \DateTime())->modify("-30 days"));
$emprunt->setDateRetourEstime((new \DateTime())->modify("+10 days"));
$emprunt->empruntEnRetard();

