<?php
/**
 * Template file for Lycée Jean Mermoz website
 * This template demonstrates how to use all components
 */

// Include database connection if needed
// include 'includes/db_connect.php';

// Set page-specific variables
$pageTitle = "Titre de la page";
$pageSpecificCSS = "css/pages/formation.css"; // Uncomment if needed
$pageSpecificJS = "js/page-specific/formation.js"; // Uncomment if needed

// Include header
include 'includes/header.php';
?>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Main content goes here -->
        <section class="page-section">
            <div class="container">
                <h1><?php echo $pageTitle; ?></h1>
                <p>Contenu de la page...</p>
                
                <!-- Example of database content -->
                <?php if (isset($db)): ?>
                    <!-- Database query example -->
                    <?php
                    /*
                    try {
                        $stmt = $db->prepare("SELECT * FROM your_table LIMIT 5");
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if ($results) {
                            echo '<div class="results">';
                            foreach ($results as $row) {
                                echo '<div class="result-item">';
                                echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                                echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                                echo '</div>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>Aucun résultat trouvé.</p>';
                        }
                    } catch(PDOException $e) {
                        echo '<p>Erreur: ' . $e->getMessage() . '</p>';
                    }
                    */
                    ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html> 