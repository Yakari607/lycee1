# Système de Médias pour les Actualités - Version Simple

Ce système permet d'intégrer des images et des PDF directement dans le contenu des actualités, en plus de l'image de couverture. **Interface simplifiée** pour un usage facile.

## Installation

1. **Créer la base de données** :
   ```sql
   mysql -u root -p lycee1 < db-actualites-media.sql
   ```

2. **Vérifier les permissions** :
   - Le dossier `uploads/actualites/` doit être accessible en écriture
   - Les fichiers PHP dans `admin/` doivent être accessibles uniquement aux administrateurs

## Utilisation Simple

### Dans l'administration

1. **Créer ou éditer une actualité** dans `admin/actualites-admin.php`
2. **Cliquer sur "Sélectionner des fichiers"** pour choisir vos images/PDF
3. **Upload automatique** :
   - Images : JPG, PNG, GIF, WebP
   - Documents : PDF
   - Taille maximum : 10MB par fichier
   - **Upload multiple** supporté
4. **Copier les codes** générés et les coller dans le contenu
5. **Ou utiliser le bouton "Insérer"** pour ajouter automatiquement

### Shortcodes disponibles

#### Images
```
[image id="123" align="center"]
[image id="123" align="left"]  
[image id="123" align="right"]
```

#### PDF
```
[pdf id="123" title="Mon document"]
[pdf id="123"]
```

#### Média générique
```
[media id="123"]
```

### Interface Simplifiée

**Avantages du nouveau système :**
- ✅ **Sélection directe** de fichiers depuis l'ordinateur
- ✅ **Upload multiple** en une seule fois
- ✅ **Codes générés automatiquement** après upload
- ✅ **Bouton "Insérer"** pour ajout direct dans le contenu
- ✅ **Copie en un clic** des codes dans le presse-papiers
- ✅ **Aperçu des médias** existants avec leurs codes
- ✅ **Pas de modal compliqué** - tout dans la même page

### Exemples d'utilisation

**Workflow simple :**
1. Cliquer sur "Sélectionner des fichiers"
2. Choisir plusieurs images/PDF
3. Attendre l'upload (barre de progression)
4. Cliquer sur "Insérer" ou copier le code
5. Coller dans le contenu de l'actualité

**Contenu d'actualité avec médias intégrés :**

```
Voici le début de notre actualité.

[image id="45" align="center"]

Après cette image, voici un paragraphe explicatif. L'image sera centrée et responsive.

[image id="46" align="left"]

Cette image sera alignée à gauche, le texte va s'enrouler autour.

Vous pouvez également intégrer des documents PDF :

[pdf id="47" title="Règlement intérieur 2024"]

Le PDF s'affichera avec un aperçu et des boutons de visualisation/téléchargement.
```

## Structure des fichiers

```
/
├── uploads/actualites/          # Dossier des médias uploadés
├── admin/
│   ├── actualites-admin.php     # Interface d'administration modifiée
│   └── upload-actualite-media.php # Gestion des uploads
├── includes/
│   └── actualite-functions.php  # Fonctions de traitement des médias
├── css/pages/
│   └── actualite.css           # Styles pour les médias intégrés  
├── actualite.php               # Affichage modifié avec traitement des médias
└── db-actualites-media.sql     # Structure de base de données
```

## Fonctionnalités

### Côté administration
- **Upload par drag & drop** ou sélection de fichiers
- **Aperçu des médias** uploadés
- **Insertion automatique** des shortcodes
- **Suppression** des médias inutilisés
- **Descriptions** optionnelles pour les médias

### Côté affichage
- **Rendu responsive** des images
- **Alignement configurable** (gauche, centre, droite)
- **Légendes** automatiques depuis les descriptions
- **Aperçu PDF** avec boutons de visualisation/téléchargement
- **Gestion d'erreurs** pour les médias manquants

### Sécurité
- **Vérification des types de fichiers**
- **Limitation de taille** (10MB)
- **Noms de fichiers sécurisés**
- **Vérification d'appartenance** des médias aux actualités
- **Protection contre l'accès direct** aux fichiers d'administration

## Personnalisation

### Styles CSS
Les styles peuvent être personnalisés dans `css/pages/actualite.css` :

- `.actualite-media-image` : Images intégrées
- `.actualite-media-pdf` : PDFs intégrés  
- `.media-error` : Messages d'erreur
- Mode sombre supporté automatiquement

### Types de fichiers
Pour ajouter d'autres types, modifier `admin/upload-actualite-media.php` :

```php
$allowed_types = [
    'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
    'pdf' => ['pdf'],
    'video' => ['mp4', 'webm'] // Exemple d'ajout
];
```

## Dépannage

### Les médias ne s'affichent pas
1. Vérifier que le fichier `includes/actualite-functions.php` est bien inclus
2. Vérifier les permissions du dossier `uploads/actualites/`
3. Vérifier que la base de données contient la table `lycee1_actualites_media`

### Erreurs d'upload
1. Vérifier la taille maximum autorisée dans PHP (`upload_max_filesize`)
2. Vérifier les permissions d'écriture du dossier
3. Vérifier que l'extension du fichier est autorisée

### Shortcodes non traités
1. S'assurer que `process_actualite_content()` est appelée dans `actualite.php`
2. Vérifier la syntaxe des shortcodes (guillemets, IDs valides)

## Test Rapide

Pour tester le système :

1. **Créer la base de données** : `mysql -u root -p lycee1 < db-actualites-media.sql`
2. **Visiter la page de test** : `test-actualites-medias-simple.php`
3. **Aller dans l'admin** : `admin/actualites-admin.php`
4. **Créer une actualité** et uploader des fichiers
5. **Voir le résultat** sur `actualite.php?id=X`

## Support

Ce système est compatible avec :
- PHP 7.4+
- MySQL 5.7+
- Navigateurs modernes (Chrome, Firefox, Safari, Edge)
- Appareils mobiles (responsive)

## Améliorations vs Ancien Système

- ❌ **Ancien** : Modal complexe, drag & drop, interface compliquée
- ✅ **Nouveau** : Interface simple, sélection directe, codes automatiques
- ❌ **Ancien** : Upload un par un
- ✅ **Nouveau** : Upload multiple en batch
- ❌ **Ancien** : Insertion manuelle des IDs
- ✅ **Nouveau** : Codes générés automatiquement 