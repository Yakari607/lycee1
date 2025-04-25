// Gestion des sections dépliables dans la page de formation
document.addEventListener('DOMContentLoaded', () => {
    // Gestion des en-têtes dépliables
    const collapsibleHeaders = document.querySelectorAll('.collapsible-header');
    
    collapsibleHeaders.forEach(header => {
        header.addEventListener('click', () => {
            // Toggle la classe active sur l'en-tête
            header.classList.toggle('active');
            
            // Récupère le contenu associé
            const content = header.nextElementSibling;
            
            // Toggle la classe active sur le contenu
            content.classList.toggle('active');
            
            // Ajuste la hauteur max pour l'animation
            if (content.classList.contains('active')) {
                content.style.maxHeight = content.scrollHeight + 'px';
            } else {
                content.style.maxHeight = '0';
            }
        });
    });
    
    // Animation des éléments de la timeline au défilement
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.2 });
    
    // Observe tous les nœuds de la timeline
    document.querySelectorAll('.timeline-node').forEach(node => {
        // Applique un état initial (pour l'animation)
        node.style.opacity = '0';
        node.style.transform = 'translateY(20px)';
        node.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        // Observe le nœud
        observer.observe(node);
    });
}); 