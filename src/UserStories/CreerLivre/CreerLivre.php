<?php

namespace App\UserStories\CreerLivre;

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

        // Vérifier que l'isbn n'existe pas déjà

        // Créer livre
        $livre = new Livre();
        $livre->setTitre($requete->titre);
        $livre->setAuteur($requete->auteur);
        $livre->setDateCreation($requete->dateParution);
        $livre->setIsbn($requete->isbn);
        $livre->setNbrPage($requete->nbrPages);
        $livre->setDureeEmprunt();
        $livre->setStatus("nouveau");

        $this->entityManager->persist($livre);
        $this->entityManager->flush();
        return true;

    }


}