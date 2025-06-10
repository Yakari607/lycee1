<?php
// Script pour configurer automatiquement les plaquettes
require_once 'includes/db_connect.php';

echo "<h1>Configuration automatique des plaquettes</h1>";

try {
    // Récupérer la plaquette existante (ID 4)
    $stmt = $db->prepare("SELECT * FROM plaquettes WHERE id = 4");
    $stmt->execute();
    $plaquette = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($plaquette) {
        echo "<h2>Plaquette trouvée: " . htmlspecialchars($plaquette['titre']) . "</h2>";
        
        // Décoder les pages actuelles
        $pages_actuelles = json_decode($plaquette['pages_affichage'], true);
        echo "<p>Pages actuelles: " . implode(', ', $pages_actuelles) . "</p>";
        
        // Ajouter cap-psr.php si elle n'y est pas déjà
        if (!in_array('cap-psr.php', $pages_actuelles)) {
            $pages_actuelles[] = 'cap-psr.php';
            $pages_json = json_encode($pages_actuelles);
            
            // Mettre à jour la base de données
            $update_stmt = $db->prepare("UPDATE plaquettes SET pages_affichage = :pages WHERE id = 4");
            $update_stmt->execute([':pages' => $pages_json]);
            
            echo "<p style='color: green; font-weight: bold;'>✓ cap-psr.php ajouté aux pages d'affichage</p>";
            echo "<p>Nouvelles pages: " . implode(', ', $pages_actuelles) . "</p>";
        } else {
            echo "<p style='color: blue;'>cap-psr.php est déjà dans les pages d'affichage</p>";
        }
        
        // Vérifier que la plaquette est active
        if ($plaquette['actif'] != 1) {
            $db->prepare("UPDATE plaquettes SET actif = 1 WHERE id = 4")->execute();
            echo "<p style='color: green;'>✓ Plaquette activée</p>";
        } else {
            echo "<p style='color: blue;'>La plaquette est déjà active</p>";
        }
        
        echo "<h3>Configuration terminée !</h3>";
        echo "<p><a href='cap-psr.php' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Voir la page CAP PSR</a></p>";
        echo "<p><a href='debug-plaquettes.php' style='background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Vérifier le debug</a></p>";
        
    } else {
        echo "<p style='color: red;'>Aucune plaquette trouvée avec l'ID 4</p>";
        
        // Créer une nouvelle plaquette de test pour cap-psr.php
        echo "<h2>Création d'une plaquette de test pour CAP PSR</h2>";
        
        $pages_cap_psr = json_encode(['cap-psr.php']);
        
        $insert_stmt = $db->prepare("INSERT INTO plaquettes (titre, description, pages_affichage, couleur_fond, actif, date_creation) VALUES (:titre, :description, :pages, :couleur, 1, NOW())");
        $insert_stmt->execute([
            ':titre' => 'Plaquette CAP PSR',
            ':description' => 'Brochure d\'information sur la formation CAP Production et Service en Restaurations',
            ':pages' => $pages_cap_psr,
            ':couleur' => '#ff6b35'
        ]);
        
        echo "<p style='color: green;'>✓ Nouvelle plaquette créée pour CAP PSR</p>";
        echo "<p style='color: orange;'>⚠️ Vous devrez ajouter les fichiers PDF et image via l'interface d'administration</p>";
        echo "<p><a href='admin/plaquettes-admin.php' style='background: #ffc107; color: black; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Aller à l'administration</a></p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
}
?> 