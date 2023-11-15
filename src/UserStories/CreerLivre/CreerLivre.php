<?php

namespace App\UserStories\CreerLivre;

use App\Entites\Adherent;
use App\Entites\Livre;
use App\Services\GenerateurNumeroAdherent;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerLivre {
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

    public function execute(CreerLivreRequete $requete) :bool|Exception {
        // Valider les données en entrées (de la requête)
        $erreur = $this->validateur->validate($requete);
        if ($erreur->count()<> 0) {
            $messageErreur = ($erreur->get(0))->getMessage();
            for ($i=1;$i<$erreur->count();$i++) {
                $messageErreur .= " et ".($erreur->get($i))->getMessage();
            }
            throw new \Exception($messageErreur);
        }
        // Vérifier que l'isbn n'existe pas déjà
        $livre = $this->entityManager->getRepository(Livre::class);
        if ($livre->findOneBy(["isbn" => $requete->isbn])<>null) {
            throw new \Exception("L'isbn existe deja");
        }

        // Vérifier que le nombre de page est superieur a 0
        if ($requete->nbrPages <= 0) {
            throw new \Exception("Le nombre de page est incorrecte");
        }

        // Créer livre
        $livre = new Livre();
        $livre->setTitre($requete->titre);
        $livre->setAuteur($requete->auteur);
        $livre->setIsbn($requete->isbn);
        $livre->setNbrPage($requete->nbrPages);
        $livre->setDateCreation();
        $livre->setDureeEmprunt();
        $livre->setStatus("nouveau");

        $this->entityManager->persist($livre);
        $this->entityManager->flush();
        return true;

    }


}