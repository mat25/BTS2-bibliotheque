<?php
require "vendor/autoload.php";
require "bootstrap.php";
use App\Entites\Livre;



$livre = new Livre();
$livre->setTitre("stick");
$livre->setAuteur("michel Sardou");
$livre->setDateCreation("15/11/1988");
$livre->setIsbn("18754fzjgzu");
$livre->setNbrPage(150);
$livre->setDureeEmprunt();
$livre->setStatus("nouveau");

$entityManager->persist($livre);
$entityManager->flush();