<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-page="contact">
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="formation-hero">
            <div class="hero-content">
                <h1>Nous contacter</h1>
                <p>Prenez contact avec le Lycée Jean-Mermoz</p>
            </div>
        </section>

        <div class="container">
            <!-- Informations de contact -->
            <section class="contact-info-section">
                <div class="contact-grid">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Adresse</h3>
                        <p>Lycée Jean-Mermoz<br>
                        9 Boulevard de la Marne<br>
                        68300 Saint-Louis<br>
                        France</p>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Téléphone</h3>
                        <p><strong>Standard :</strong> 03 89 70 74 00<br>
                        <strong>Fax :</strong> 03 89 70 74 01</p>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email</h3>
                        <p><strong>Général :</strong> contact@lycee-mermoz.fr<br>
                        <strong>Scolarité :</strong> scolarite@lycee-mermoz.fr</p>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Horaires d'ouverture</h3>
                        <p><strong>Lundi à Vendredi :</strong><br>
                        8h00 - 12h00 et 13h30 - 17h00<br>
                        <strong>Mercredi :</strong> 8h00 - 12h00</p>
                    </div>
                </div>
            </section>

            <!-- Services spécialisés -->
            <section class="specialized-contacts">
                <h2>Contacts spécialisés</h2>
                <div class="services-grid">
                    <div class="service-item">
                        <h3><i class="fas fa-graduation-cap"></i> Direction</h3>
                        <p><strong>Proviseur :</strong> M./Mme [Nom]<br>
                        <strong>Proviseur Adjoint :</strong> M./Mme [Nom]<br>
                        Tel: 03 89 70 74 02</p>
                    </div>
                    
                    <div class="service-item">
                        <h3><i class="fas fa-users"></i> Vie scolaire</h3>
                        <p><strong>CPE :</strong> M./Mme [Nom]<br>
                        Tel: 03 89 70 74 03<br>
                        Email: vie-scolaire@lycee-mermoz.fr</p>
                    </div>
                    
                    <div class="service-item">
                        <h3><i class="fas fa-file-alt"></i> Scolarité</h3>
                        <p><strong>Secrétariat :</strong><br>
                        Tel: 03 89 70 74 04<br>
                        Email: scolarite@lycee-mermoz.fr</p>
                    </div>
                    
                    <div class="service-item">
                        <h3><i class="fas fa-compass"></i> Orientation</h3>
                        <p><strong>Conseiller d'orientation :</strong><br>
                        Tel: 03 89 70 74 05<br>
                        Email: orientation@lycee-mermoz.fr</p>
                    </div>
                    
                    <div class="service-item">
                        <h3><i class="fas fa-briefcase"></i> Relations entreprises</h3>
                        <p><strong>Stages & Alternance :</strong><br>
                        Tel: 03 89 70 74 06<br>
                        Email: entreprises@lycee-mermoz.fr</p>
                    </div>
                    
                    <div class="service-item">
                        <h3><i class="fas fa-wrench"></i> Services techniques</h3>
                        <p><strong>Gestionnaire :</strong><br>
                        Tel: 03 89 70 74 07<br>
                        Email: gestion@lycee-mermoz.fr</p>
                    </div>
                </div>
            </section>

            <!-- Formulaire de contact -->
            <section class="contact-form-section">
                <h2>Envoyez-nous un message</h2>
                <div class="form-container">
                    <form class="contact-form" action="#" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom *</label>
                                <input type="text" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom *</label>
                                <input type="text" id="prenom" name="prenom" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="tel" id="telephone" name="telephone">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="qualite">Vous êtes :</label>
                            <select id="qualite" name="qualite">
                                <option value="">Sélectionnez...</option>
                                <option value="parent">Parent d'élève</option>
                                <option value="eleve">Élève</option>
                                <option value="etudiant">Étudiant</option>
                                <option value="professionnel">Professionnel</option>
                                <option value="enseignant">Enseignant</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="sujet">Sujet de votre message</label>
                            <select id="sujet" name="sujet">
                                <option value="">Sélectionnez un sujet...</option>
                                <option value="inscription">Inscription / Admission</option>
                                <option value="scolarite">Scolarité</option>
                                <option value="orientation">Orientation</option>
                                <option value="stage">Stages en entreprise</option>
                                <option value="alternance">Alternance / Apprentissage</option>
                                <option value="partenariat">Partenariat</option>
                                <option value="vie-scolaire">Vie scolaire</option>
                                <option value="restauration">Restauration</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Votre message *</label>
                            <textarea id="message" name="message" rows="6" required placeholder="Décrivez votre demande..."></textarea>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="rgpd" name="rgpd" required>
                            <label for="rgpd">J'accepte que mes données personnelles soient utilisées pour répondre à ma demande. *</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </section>

            <!-- Plan d'accès -->
            <section class="map-section">
                <h2>Plan d'accès</h2>
                <div class="map-container">
                    <div class="map-info">
                        <h3>Comment nous trouver</h3>
                        <div class="transport-info">
                            <div class="transport-item">
                                <i class="fas fa-car"></i>
                                <div>
                                    <h4>En voiture</h4>
                                    <p>Parking disponible dans l'établissement<br>
                                    Accès depuis l'A35 sortie Saint-Louis</p>
                                </div>
                            </div>
                            <div class="transport-item">
                                <i class="fas fa-bus"></i>
                                <div>
                                    <h4>En transports en commun</h4>
                                    <p>Lignes de bus : 1, 3, 7<br>
                                    Arrêt : "Lycée Jean-Mermoz"</p>
                                </div>
                            </div>
                            <div class="transport-item">
                                <i class="fas fa-train"></i>
                                <div>
                                    <h4>En train</h4>
                                    <p>Gare SNCF de Saint-Louis<br>
                                    À 10 minutes à pied du lycée</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map-embed">
                        <!-- Remplacez par une vraie carte ou utilisez un iframe Google Maps -->
                        <div class="map-placeholder">
                            <i class="fas fa-map-marked-alt"></i>
                            <p>Carte interactive</p>
                            <small>9 Boulevard de la Marne, 68300 Saint-Louis</small>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/script.js"></script>

    <style>
        .contact-info-section {
            margin: 3rem 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .contact-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .contact-icon i {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .specialized-contacts {
            margin: 4rem 0;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .service-item {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .service-item h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-form-section {
            background: var(--gray-light);
            padding: 3rem;
            border-radius: 10px;
            margin: 4rem 0;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-form {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .checkbox-group input {
            width: auto;
            margin: 0;
        }

        .checkbox-group label {
            margin: 0;
            font-weight: normal;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        .map-section {
            margin: 4rem 0;
        }

        .map-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin: 2rem 0;
        }

        .transport-info {
            margin-top: 2rem;
        }

        .transport-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin: 1.5rem 0;
            padding: 1rem;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .transport-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-top: 0.25rem;
        }

        .transport-item h4 {
            margin: 0 0 0.5rem 0;
            color: var(--text-color);
        }

        .map-embed {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .map-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 400px;
            color: var(--text-muted);
            background: var(--gray-light);
        }

        .map-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .map-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .contact-grid,
            .services-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .contact-form-section {
                padding: 2rem 1rem;
            }

            .contact-form {
                padding: 1.5rem;
            }
        }
    </style>

    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>
</body>
</html> 