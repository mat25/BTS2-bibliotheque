<?php

namespace App\UserStories\CreerMagazine;



use App\Entites\Magazine;
use App\Entites\StatusMedia;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerMagazine {
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validateur;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validateur
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validateur)
    {
        $this->entityManager = $entityManager;
        $this->validateur = $validateur;
    }

    public function execute(CreerMagazineRequete $requete) :bool|Exception {
        // Valider les données en entrées (de la requête)
        $erreur = $this->validateur->validate($requete);
        if ($erreur->count()<> 0) {
            $messageErreur = ($erreur->get(0))->getMessage();
            for ($i=1;$i<$erreur->count();$i++) {
                $messageErreur .= " et ".($erreur->get($i))->getMessage();
            }
            throw new \Exception($messageErreur);
        }


        // Vérifier que la date de publication soit valide
        $datePublicationExplode = explode("/",$requete->datePublication);
        if (count($datePublicationExplode) <> 3) {
            throw new \Exception("Le format de la date n'est pas bon");
        }
        if ($datePublicationExplode[0] < 0 or $datePublicationExplode[0] > 31) {
            throw new \Exception("Le format de la date n'est pas bon");
        }
        if ($datePublicationExplode[1] < 0 or $datePublicationExplode[1] > 12) {
            throw new \Exception("Le format de la date n'est pas bon");
        }
        if ($datePublicationExplode[2] < 0 or $datePublicationExplode[2] > date('Y')) {
            throw new \Exception("Le format de la date n'est pas bon");
        }

        // Vérifier que le numero magazin est positif
        if ($requete->numeroMagazine <= 0) {
            throw new \Exception("Le nombre de magazine est incorrecte");
        }

        // Créer livre
        $magazine = new Magazine();
        $magazine->setTitre($requete->titre);
        $magazine->setNumeroMagazine($requete->numeroMagazine);
        $magazine->setDatePublication($requete->datePublication);
        $magazine->setDateCreation();
        $magazine->setDureeEmprunt();
        $magazine->setStatus(StatusMedia::NEW);

        $this->entityManager->persist($magazine);
        $this->entityManager->flush();
        return true;

    }


}