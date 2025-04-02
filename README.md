# Site Web du Lycée Jean Mermoz

Ce projet contient les fichiers source pour le site web du Lycée Jean Mermoz. La structure est conçue pour être facilement intégrable dans WordPress.

## Structure du Projet

```
.
├── index.html          # Page d'accueil
├── styles.css          # Styles CSS
└── images/            # Dossier contenant les images
    ├── logo.png       # Logo du lycée
    ├── hero-bg.jpg    # Image d'arrière-plan de la section hero
    ├── actu1.jpg      # Image pour la première actualité
    └── actu2.jpg      # Image pour la deuxième actualité
```

## Instructions pour l'Intégration WordPress

Pour intégrer ce design dans WordPress :

1. Créer un nouveau thème WordPress
2. Copier le contenu de `styles.css` dans le fichier `style.css` du thème
3. Utiliser le contenu de `index.html` comme base pour créer les templates WordPress :
   - `header.php` pour la navigation
   - `front-page.php` pour la page d'accueil
   - `footer.php` pour le pied de page

## Personnalisation

Les couleurs principales du site sont définies dans des variables CSS au début du fichier `styles.css`. Pour modifier le thème de couleurs, ajustez ces variables :

```css
:root {
    --primary-color: #0066cc;
    --secondary-color: #003366;
    --accent-color: #ff9900;
    --text-color: #333333;
    --light-gray: #f5f5f5;
    --dark-gray: #666666;
}
```

## Responsive Design

Le site est entièrement responsive et s'adapte à tous les écrans. Pour la version mobile, un menu hamburger devra être ajouté (le code CSS est déjà préparé pour cela). 