<?php
/**
 * Page de déconnexion pour l'administration
 * Lycée Jean Mermoz - Saint-Louis
 */

// Démarrer la session
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Si on veut détruire complètement la session, effacer aussi le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, détruire la session
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - Administration Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .logout-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, #000066 100%);
            padding: 2rem;
        }
        
        .logout-card {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        
        .logout-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }
        
        .logout-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .logout-message {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }
        
        .logout-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 0.8rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: #000066;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
            transform: translateY(-2px);
        }
        
        .countdown {
            color: #666;
            font-size: 0.9rem;
            margin-top: 1rem;
            font-style: italic;
        }
        
        @media (max-width: 576px) {
            .logout-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            .logout-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-card">
            <div class="logout-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1 class="logout-title">Déconnexion réussie</h1>
            
            <p class="logout-message">
                Vous avez été déconnecté(e) avec succès de l'interface d'administration du Lycée Jean Mermoz.
                <br><br>
                Merci pour votre session de travail.
            </p>
            
            <div class="logout-actions">
                <a href="login.php" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Se reconnecter
                </a>
                <a href="../index.php" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
            </div>
            
            <div class="countdown">
                Redirection automatique vers l'accueil dans <span id="countdown">10</span> secondes...
            </div>
        </div>
    </div>

    <script>
        // Redirection automatique après 10 secondes
        let timeLeft = 10;
        const countdownElement = document.getElementById('countdown');
        
        const countdown = setInterval(() => {
            timeLeft--;
            countdownElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = '../index.php';
            }
        }, 1000);
        
        // Possibilité d'annuler la redirection en cliquant sur la page
        document.addEventListener('click', () => {
            clearInterval(countdown);
            document.querySelector('.countdown').style.display = 'none';
        });
    </script>
</body>
</html> 