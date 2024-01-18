# Rendre disponible un nouveau média

## Description
**En tant que** bibliothécaire   
**Je veux** rendre disponible un nouveau média  
**Afin de** le rendre empruntable par les adhérents de la bibliothèque

## Indications
- L’accès au média à rendre disponible se fais via son id.

## Critères d'acceptation

### Média existe
- Le média que l’on souhaite rendre disponible doit exister
### Statut du média
- Seul un média ayant le statut “Nouveau” peut-être rendu disponible.


### Enregistrement dans la base de données
- Le changement de statut du média doit être correctement enregistré dans la base de données.

### Gestion des erreurs
- Des messages d'erreurs explicites sont retournés en cas d'informations manquantes ou invalides