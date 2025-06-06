    </div> <!-- Fin du conteneur principal -->

    <footer class="admin-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Lycée Jean-Mermoz - Interface d'administration</p>
        </div>
    </footer>

    <script>
    // Script pour le bouton de copie des liens
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copy-btn');
        if (copyButtons.length > 0) {
            copyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const link = this.getAttribute('data-link');
                    navigator.clipboard.writeText(link).then(() => {
                        this.textContent = 'Copié!';
                        setTimeout(() => {
                            this.textContent = 'Copier';
                        }, 2000);
                    });
                });
            });
        }
    });
    </script>
</body>
</html> 