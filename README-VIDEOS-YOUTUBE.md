# Système de gestion des vidéos YouTube - Lycée Jean-Mermoz

## 📋 Description

Ce système permet de gérer et d'afficher les vidéos YouTube du lycée Jean-Mermoz. Il comprend :

- **Page d'administration** : Pour ajouter, modifier et supprimer des vidéos
- **Page publique** : Pour afficher les vidéos aux visiteurs
- **Système de catégories** : Pour organiser les vidéos par thème
- **Modal de lecture** : Pour regarder les vidéos directement sur le site

## 🚀 Installation

### 1. Création de la base de données

Exécutez le script d'installation :

```bash
# Accédez à votre navigateur et visitez :
http://votre-domaine.com/installer-videos-youtube.php
```

Ou importez directement le fichier SQL :

```sql
-- Exécutez le contenu du fichier db-videos-youtube.sql
```

### 2. Vérification

Après l'installation, vous devriez avoir :
- ✅ Table `videos_youtube` créée
- ✅ 3 vidéos d'exemple ajoutées
- ✅ Accès à l'administration via `admin/videos-youtube-admin.php`

## 📁 Structure des fichiers

```
lycee1/
├── admin/
│   └── videos-youtube-admin.php    # Page d'administration
├── css/
│   └── pages/
│       └── videos-youtube.css      # Styles de la page publique
├── videos-youtube.php              # Page publique
├── installer-videos-youtube.php    # Script d'installation
├── db-videos-youtube.sql           # Structure de la base de données
└── README-VIDEOS-YOUTUBE.md        # Ce fichier
```

## 🎯 Utilisation

### Administration

1. **Accès** : `admin/videos-youtube-admin.php`
2. **Authentification** : Utilisez vos identifiants admin existants
3. **Fonctionnalités** :
   - Ajouter une nouvelle vidéo
   - Modifier une vidéo existante
   - Supprimer une vidéo
   - Gérer les catégories
   - Contrôler l'ordre d'affichage

### Ajout d'une vidéo

1. Cliquez sur "Ajouter une nouvelle vidéo"
2. Remplissez les champs :
   - **Titre** : Nom de la vidéo (obligatoire)
   - **Description** : Description détaillée (optionnel)
   - **URL YouTube** : Lien vers la vidéo (obligatoire)
   - **Catégorie** : Thème de la vidéo
   - **Date de publication** : Date de sortie
   - **Ordre d'affichage** : Position dans la liste
   - **Actif** : Activer/désactiver la vidéo

### Formats d'URL YouTube acceptés

- `https://www.youtube.com/watch?v=VIDEO_ID`
- `https://youtu.be/VIDEO_ID`
- `https://www.youtube.com/embed/VIDEO_ID`

### Page publique

1. **Accès** : `videos-youtube.php`
2. **Fonctionnalités** :
   - Affichage en grille des vidéos
   - Filtrage par catégorie
   - Lecture en modal
   - Design responsive
   - Animations fluides

## 🎨 Personnalisation

### Styles CSS

Modifiez `css/pages/videos-youtube.css` pour personnaliser :
- Couleurs et thème
- Disposition des cartes
- Animations
- Responsive design

### Catégories

Les catégories sont créées automatiquement lors de l'ajout de vidéos. Exemples :
- Présentation
- Événements
- Formations
- Vie lycéenne
- Portes ouvertes

## 🔧 Fonctionnalités techniques

### Extraction automatique de l'ID YouTube

Le système extrait automatiquement l'ID YouTube de l'URL fournie et :
- Génère l'URL d'embed pour la lecture
- Récupère la miniature de la vidéo
- Valide le format de l'URL

### Sécurité

- Validation des URLs YouTube
- Protection contre les injections SQL
- Échappement des caractères spéciaux
- Authentification requise pour l'administration

### Performance

- Indexation des colonnes importantes
- Chargement optimisé des images
- Modal de lecture pour éviter les rechargements

## 🐛 Dépannage

### Problèmes courants

1. **Vidéo ne s'affiche pas**
   - Vérifiez que l'URL YouTube est valide
   - Assurez-vous que la vidéo n'est pas privée
   - Testez l'URL dans un navigateur

2. **Erreur de base de données**
   - Vérifiez la connexion dans `includes/db_connect.php`
   - Assurez-vous que la table existe
   - Relancez le script d'installation

3. **Problème d'affichage**
   - Vérifiez que le fichier CSS est chargé
   - Testez sur différents navigateurs
   - Vérifiez la console pour les erreurs JavaScript

### Logs d'erreur

Les erreurs sont loggées dans :
- Console du navigateur (F12)
- Logs PHP du serveur
- Messages d'erreur affichés sur les pages

## 📝 Maintenance

### Sauvegarde

Sauvegardez régulièrement :
- La table `videos_youtube`
- Les fichiers de configuration
- Les personnalisations CSS

### Mise à jour

Pour mettre à jour le système :
1. Sauvegardez vos données
2. Remplacez les fichiers modifiés
3. Testez sur un environnement de développement
4. Déployez en production

## 🤝 Support

Pour toute question ou problème :
1. Consultez ce README
2. Vérifiez les logs d'erreur
3. Testez sur un navigateur différent
4. Contactez l'équipe technique

## 📄 Licence

Ce système fait partie du site web du Lycée Jean-Mermoz et est destiné à un usage interne.

---

**Version** : 1.0  
**Date** : 2024  
**Auteur** : Équipe technique Lycée Jean-Mermoz 