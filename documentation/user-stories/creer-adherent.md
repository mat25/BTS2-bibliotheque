# Créer un adhérent

## Description
**En tant que** bibliothécaire  
**Je veux** créer un adhérent  
**Afin de** gérer son accès et ses emprunts au sein de la bibliothèque

---
## Critères d'acceptation

### Validation des données
- L'email doit être valide et unique
- Le nom et le prénom doivent être renseignés

### Génération du numéro d'adhérent
- Un numéro d'adhérent doit être généré automatiquement lors de la création de l'adhérent
- Il doit respecter le format "AD-999999"

### Génération de la date d'adhésion
- La date d'adhésion doit être générée automatiquement lors de la création de l'adhérent et correspondre à la date du jour

### Enregistrement des données
- Les informations de l'adhérent doivent être correctement enregistrées en base de données

### Gestion des erreurs
- Des messages d'erreurs explicites doivent être retournés en cas d'informations manquantes ou invalides
- Des messages d'erreurs explicites doivent être retournés en cas d'erreur lors de l'enregistrement des données
