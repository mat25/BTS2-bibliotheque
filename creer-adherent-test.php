<?php
require "bootstrap.php";
use App\Entites\Adherent;



$adherent = new Adherent();
$adherent->setNumeroAdherent();
$adherent->setNom("Jean");
$adherent->setPrenom("Mateo");
$adherent->setEmail("mateoj@gmail.com");
$adherent->setDateAdhesion("15/10/2023");

$entityManager->persist($adherent);
$entityManager->flush();