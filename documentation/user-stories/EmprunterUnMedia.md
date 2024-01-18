# Emprunter un média

## Description
**En tant que** bibliothécaire   
**Je veux** enregistrer un emprunt de média disponible pour un adhérent  
**Afin de** permettre à l’adhérent d’utiliser ce média pour pour durée déterminée  

## Indications
- Pour enregistrer l’emprunt, le bibliothécaire aura besoin de l’id du média et du numéro d’adhérent de l’emprunteur.

## Critères d'acceptation

### Média
- Le média doit exister dans la base de données
- Le média doit être disponible
### Adhérent
- L’adhérent doit exister dans la base de données 
- L’adhésion de l’adhérent doit être valide

### Enregistrement dans la base de données
- le statut du média passe à “Emprunte”.

### Gestion des erreurs
- Des messages d'erreurs explicites sont retournés en cas d'informations manquantes ou invalides