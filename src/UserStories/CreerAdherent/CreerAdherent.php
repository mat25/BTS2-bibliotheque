<?php

namespace App\UserStories\CreerAdherent;

use App\Entites\Adherent;
use App\Services\GenerateurNumeroAdherent;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\New_;
use PHPUnit\Logging\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerAdherent
{
    // Dépendances
    private EntityManagerInterface $entityManager;
    private GenerateurNumeroAdherent $numeroAdherent;
    private ValidatorInterface $validateur;

    /**
     * @param EntityManagerInterface $entityManager
     * @param GenerateurNumeroAdherent $numeroAdherent
     * @param ValidatorInterface $validateur
     */
    public function __construct(EntityManagerInterface $entityManager, GenerateurNumeroAdherent $numeroAdherent, ValidatorInterface $validateur)
    {
        $this->entityManager = $entityManager;
        $this->numeroAdherent = $numeroAdherent;
        $this->validateur = $validateur;
    }


    /**
     * @throws \Exception
     */
    public function execute(CreerAdherentRequete $requete) :  bool|Exception {

        // Valider les données en entrées (de la requête)
        $erreur = $this->validateur->validate($requete);
        if ($erreur->count()<> 0) {
            $messageErreur = ($erreur->get(0))->getMessage();
            for ($i=1;$i<$erreur->count();$i++) {
                $messageErreur .= " et ".($erreur->get($i))->getMessage();
            }
            throw new \Exception($messageErreur);
        }
        // Vérifier que l'email n'existe pas déjà
        $adherents = $this->entityManager->getRepository(Adherent::class);
        if ($adherents->findOneBy(["email" => $requete->email])<>null) {
            throw new \Exception("L'email existe deja");
        }
        // Générer un numéro d'adhérent au format AD-999999
        $numeroAdherent = $this->numeroAdherent->generer();

        // Vérifier que le numéro n'existe pas déjà
        if ($adherents->findOneBy(["numeroAdherent" => $numeroAdherent])<>null) {
            throw new \Exception("Le numéro d'adherents existe deja");
        }

        // Créer l'adhérent
        $adherent = new Adherent();
        $adherent->setNumeroAdherent($numeroAdherent);
        $adherent->setPrenom($requete->prenom);
        $adherent->setNom($requete->nom);
        $adherent->setEmail($requete->email);
        $adherent->setDateAdhesion(new \DateTime());

        // Enregistrer l'adhérent en base de données
        $this->entityManager->persist($adherent);
        $this->entityManager->flush();
        return true;
    }
}