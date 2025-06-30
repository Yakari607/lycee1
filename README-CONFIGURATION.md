# Configuration de la base de données

## Problème résolu

L'erreur `SQLSTATE[HY000] [2002] No such file or directory` était causée par une configuration incorrecte dans `includes/db_connect.php`.

## Configuration actuelle

### Production (actif)
- **Host :** `lyceemerqagora.mysql.db`
- **Base :** `lyceemerqagora`
- **User :** `lyceemerqagora`
- **Password :** `Mermoz68300Illzach`

### Développement local (désactivé)
- **Host :** `localhost`
- **Base :** `lycee1`
- **User :** `root`
- **Password :** (vide)

## Comment changer de configuration

### Pour le développement local
1. Renommez `includes/db_connect.php` en `includes/db_connect_prod.php`
2. Renommez `includes/db_connect_local.php` en `includes/db_connect.php`

### Pour la production
1. Renommez `includes/db_connect.php` en `includes/db_connect_local.php`
2. Renommez `includes/db_connect_prod.php` en `includes/db_connect.php`

## Vérification

Après le changement, l'erreur de connexion devrait disparaître et le site devrait fonctionner normalement.

## Notes importantes

- Ne jamais commiter les mots de passe en production dans Git
- Toujours tester la connexion après un changement de configuration
- Garder une sauvegarde de la configuration de production 