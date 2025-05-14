<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Voix des Apprentis - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/voix-apprentis.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Navigation principale -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>La Voix des Apprentis</h1>
                <p class="subtitle">Un journal ouvert sur le monde et l'intime</p>
            </div>
        </section>

        <section class="presentation-section">
            <div class="container">
                <div class="presentation-content">
                    <div class="presentation-text">
                        <h2>Un projet pédagogique</h2>
                        <p>La Voix des Apprentis est le résultat d'un projet avec une finalité et des objectifs. Il s'inscrit dans un cadre d'apprentissage et de réinvestissement des compétences acquises par les apprentis durant toute leur scolarité.</p>

                        <h3>Finalité</h3>
                        <p>La Voix des Apprentis se place dans une dynamique de valorisation qui souhaite donner aux apprentis un sens à leur travail en développant :</p>
                        <ul>
                            <li>esprit critique,</li>
                            <li>rigueur,</li>
                            <li>créativité,</li>
                            <li>autonomie.</li>
                        </ul>

                        <h3>Objectifs</h3>
                        <p>Concevoir, réaliser et diffuser La Voix des Apprentis : les apprentis et les enseignants sont sollicités à chacune des étapes, afin d'inscrire ce projet dans une démarche de communication, en développant des compétences tant disciplinaires que transversales et en menant un travail interdisciplinaire notamment grâce au thème de la rubrique « Dossier ».</p>

                        <p>Le contenu du journal a une double origine :</p>
                        <ul>
                            <li>productions libres,</li>
                            <li>productions effectuées dans le cadre d'objectifs disciplinaires, abordés avec les enseignants.</li>
                        </ul>

                        <p>Outil de contextualisation, vecteur de lien social et de valorisation, ouvert sur le monde et l'intime, La Voix des Apprentis permet d'incarner les différentes productions, afin que chaque apprenti trouve sa place en tant qu'apprenti-citoyen.</p>

                        <div class="directeur-info">
                            <p><strong>Directeur de la publication et de la rédaction :</strong> Olivier Blum (olivier.blum@cfa-academique.fr)</p>
                        </div>
                    </div>
                    <div class="presentation-image">
                        <img src="images/voix-apprentis/journal-illustration.jpg" alt="La Voix des Apprentis - Journal" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="journals-section">
            <div class="container">
                <h2>Découvrez tous nos numéros ouverts sur le monde et l'intime...</h2>
                
                <?php
                // Connexion à la base de données
                require_once 'includes/db_connect.php';
                
                try {
                    // Récupération des journaux depuis la base de données
                    $stmt = $db->query("SELECT * FROM voix_apprentis_journaux ORDER BY numero DESC");
                    $journaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (count($journaux) > 0) {
                        echo '<div class="journals-grid">';
                        foreach ($journaux as $journal) {
                            echo '<div class="journal-card">';
                            echo '<div class="journal-image">';
                            echo '<img src="' . htmlspecialchars($journal['image']) . '" alt="Journal numéro ' . htmlspecialchars($journal['numero']) . '">';
                            echo '</div>';
                            echo '<div class="journal-info">';
                            echo '<h3>Journal numéro ' . htmlspecialchars($journal['numero']) . '</h3>';
                            if (!empty($journal['theme'])) {
                                echo '<p class="journal-theme">' . htmlspecialchars($journal['theme']) . '</p>';
                            }
                            echo '<a href="' . htmlspecialchars($journal['fichier_pdf']) . '" class="btn-download" target="_blank">';
                            echo '<i class="fas fa-file-pdf"></i> Télécharger le PDF';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p class="no-journals">Aucun numéro n\'est disponible pour le moment.</p>';
                    }
                } catch (PDOException $e) {
                    echo '<p class="error-message">Erreur lors de la récupération des journaux. Veuillez réessayer plus tard.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="footer-logo">
                    <p>&copy; 2024 Lycée Jean Mermoz - Saint-Louis</p>
                </div>
                <div class="footer-links">
                    <a href="#">Mentions légales</a>
                    <a href="#">Accessibilité</a>
                    <a href="#">Plan du site</a>
                </div>
            </div>
        </div>
    </footer>

    <button class="theme-toggle" aria-label="Basculer le mode sombre">
        <i class="fas fa-moon"></i>
    </button>

    <script src="js/script.js"></script>
</body>
</html> 