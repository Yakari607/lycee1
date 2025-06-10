# Système de Gestion des Plaquettes Téléchargeables

## Description
Ce système permet aux administrateurs de gérer dynamiquement des plaquettes téléchargeables (PDF) qui peuvent être affichées sur différentes pages du site web du Lycée Jean-Mermoz.

## Fonctionnalités

### Administration
- **Interface d'administration** : `admin/plaquettes-admin.php`
- **Ajout/modification/suppression** de plaquettes
- **Upload d'images de couverture** et de fichiers PDF
- **Sélection des pages** où afficher chaque plaquette
- **Personnalisation de la couleur** de fond
- **Ordre d'affichage** configurable
- **Activation/désactivation** des plaquettes

### Affichage Public
- **Affichage automatique** sur les pages sélectionnées
- **Design responsive** et moderne
- **Intégration au footer** pour les pages sans section spécifique
- **Accessibilité** optimisée (ARIA labels, navigation clavier)

## Structure de la Base de Données

### Table `plaquettes`
```sql
CREATE TABLE IF NOT EXISTS `plaquettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `fichier_pdf` varchar(255) NOT NULL,
  `image_couverture` varchar(255) DEFAULT NULL,
  `pages_affichage` text NOT NULL COMMENT 'Pages où afficher la plaquette (JSON)',
  `couleur_fond` varchar(7) DEFAULT '#3498db',
  `ordre_affichage` int(11) DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Installation

### 1. Créer la table en base de données
Exécutez le fichier SQL `db-plaquettes.sql` dans votre base de données.

### 2. Créer les dossiers de stockage
```bash
mkdir -p images/plaquettes
mkdir -p uploads/plaquettes
```

### 3. Permissions des dossiers
Assurez-vous que les dossiers `images/plaquettes` et `uploads/plaquettes` sont accessibles en écriture par le serveur web.

## Utilisation

### Interface d'Administration

1. **Accéder à l'administration** : 
   - Se connecter à `admin/login.php`
   - Cliquer sur "Plaquettes" dans le menu de navigation

2. **Ajouter une plaquette** :
   - Remplir le formulaire avec titre, description
   - Sélectionner une couleur de fond
   - Définir l'ordre d'affichage
   - Choisir les pages où afficher la plaquette
   - Uploader une image de couverture (optionnel)
   - Uploader le fichier PDF (obligatoire)
   - Cocher "Plaquette active" pour l'activer

3. **Modifier une plaquette** :
   - Cliquer sur "Modifier" dans la liste
   - Modifier les champs souhaités
   - Les fichiers existants sont conservés si non remplacés

4. **Supprimer une plaquette** :
   - Cliquer sur "Supprimer" dans la liste
   - Confirmer la suppression
   - Les fichiers associés sont automatiquement supprimés

### Intégration dans les Pages

#### Méthode 1 : Section dédiée
Pour afficher les plaquettes dans une section dédiée avant le footer :

```php
<?php
// Inclure à la fin de la page, avant le footer
require_once 'includes/db_connect.php';
include 'includes/plaquettes.php';
display_plaquettes();
?>
```

#### Méthode 2 : Intégration au footer
Le footer inclut automatiquement les plaquettes de la page courante.

## Configuration

### Pages Disponibles
Les pages suivantes sont configurées par défaut :
- Page d'accueil (`index.php`)
- Pages de formations (Bac Pro, BTS, CAP, etc.)
- Pages des filières technologiques

Pour ajouter une nouvelle page, modifier le tableau `$pages_disponibles` dans `admin/plaquettes-admin.php`.

### Personnalisation des Styles
Les styles CSS sont inclus dans `includes/plaquettes.php` et `includes/footer.php`. 

Variables CSS principales :
- `--plaquette-bg` : Couleur de fond par défaut
- `--plaquette-text` : Couleur du texte
- `--plaquette-shadow` : Ombre des cartes

## Sécurité

### Upload de Fichiers
- **Types autorisés** : 
  - Images : JPG, JPEG, PNG, GIF, WEBP
  - Documents : PDF uniquement
- **Taille maximale** : 10 Mo par fichier
- **Noms de fichiers** : Générés automatiquement (uniqid) pour éviter les conflits

### Accès Administration
- **Authentification requise** pour accéder à l'interface d'administration
- **Validation des données** côté serveur
- **Protection CSRF** (si implémentée dans le système)

## Maintenance

### Nettoyage des Fichiers
Les fichiers sont automatiquement supprimés lors de la suppression d'une plaquette.

### Sauvegarde
Inclure dans vos sauvegardes :
- Table `plaquettes` de la base de données
- Dossiers `images/plaquettes/` et `uploads/plaquettes/`

### Logs
Les erreurs d'upload sont loggées dans les logs PHP du serveur.

## Dépannage

### Problèmes d'Upload
1. Vérifier les permissions des dossiers
2. Vérifier la configuration PHP (`upload_max_filesize`, `post_max_size`)
3. Consulter les logs d'erreur

### Plaquettes non affichées
1. Vérifier que la plaquette est active
2. Vérifier que la page courante est sélectionnée
3. Vérifier la connexion à la base de données

### Problèmes d'Affichage
1. Vérifier que les fichiers CSS sont chargés
2. Tester avec les outils de développement du navigateur
3. Vérifier la compatibilité des navigateurs

## API / Fonctions

### `get_plaquettes_for_page($page_name)`
Récupère les plaquettes actives pour une page donnée.

### `display_plaquettes($page_name = null)`
Affiche les plaquettes de la page courante ou spécifiée.

### `plaquettes_styles()`
Génère les styles CSS pour l'affichage des plaquettes.

## Évolutions Possibles

- **Catégorisation** des plaquettes
- **Statistiques** de téléchargement
- **Versionning** des fichiers
- **Aperçu** des PDFs
- **Drag & drop** pour l'upload
- **API REST** pour l'intégration externe 