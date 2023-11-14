<?php
require "./../../bootstrap.php";
require "./../../vendor/autoload.php";

use App\Services\GenerateurNumeroAdherent;
use App\UserStories\CreerAdherent\CreerAdherent;
use App\UserStories\CreerAdherent\CreerAdherentRequete;
use Symfony\Component\Validator\Validation;
$prenom = null;
$nom = null;
$email = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requete = new CreerAdherentRequete($_POST["prenom"],$_POST["nom"],$_POST["email"]);

    $prenom = $requete->prenom;
    $nom = $requete->nom;
    $email = $requete->email;

    $generateur = new GenerateurNumeroAdherent();
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $creerAdherents = new CreerAdherent($entityManager,$generateur,$validateur);

    try {
        $creerAdherents->execute($requete);
    } catch (Exception $e) {
        $erreurs = $e->getMessage();
    }

    if (empty($erreurs)) {
        header('Location: ../../index.php');
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creer un adherent</title>
</head>
<body>
    <ul>
        <li>
            <a href="../../index.php">Accueil</a>
        </li>
        <li>
            <a href="creer-adherent.php">Creer un adherents</a>
        </li>
    </ul>
    <h1>Creer un adherent</h1>
    <form action="" method="post">
        <label for="prenom"">Prenom</label>
        <input type="text" id="prenom" name="prenom" value="<?= $prenom?>">

        <label for="nom" >Nom</label>
        <input type="text" id="nom" name="nom" value="<?= $nom?>">

        <label for="email" >Email</label>
        <input type="text" id="email" name="email" value="<?= $email?>">

        <?php
        if (!empty($erreurs)) {
            echo $erreurs;
        }
        ?>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
