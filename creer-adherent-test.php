<?php
require "bootstrap.php";
use App\Entites\Adherent;



$adherent = new Adherent();
$adherent->setNumeroAdherent("AD-156580");
$adherent->setNom("Mate");
$adherent->setPrenom("JEAN");
$adherent->setEmail("mateoj@gmail.com");
$adherent->setDateAdhesion(new \DateTime());

$entityManager->persist($adherent);
$entityManager->flush();