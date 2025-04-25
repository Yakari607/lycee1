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
    
    // Anime les bulles de la timeline horizontale
    document.querySelectorAll('.timeline-bubble').forEach((bubble, index) => {
        // Applique un délai progressif pour créer un effet en cascade
        const delay = index * 100;
        bubble.style.opacity = '0';
        bubble.style.transform = 'scale(0.5)';
        bubble.style.transition = `opacity 0.5s ease ${delay}ms, transform 0.5s ease ${delay}ms`;
        
        observer.observe(bubble);
    });
    
    // Anime les boîtes de la timeline
    document.querySelectorAll('.timeline-box').forEach((box, index) => {
        // Applique un délai progressif pour apparaître après les bulles
        const delay = 300 + (index * 150);
        box.style.opacity = '0';
        box.style.transform = 'translateY(20px)';
        box.style.transition = `opacity 0.6s ease ${delay}ms, transform 0.6s ease ${delay}ms`;
        
        observer.observe(box);
    });
    
    // Anime les lignes de la timeline
    document.querySelectorAll('.timeline-line').forEach(line => {
        line.style.width = '0%';
        line.style.right = '95%';
        line.style.transition = 'width 1.2s ease, right 1.2s ease';
        
        setTimeout(() => {
            line.style.width = '90%';
            line.style.right = '5%';
        }, 500);
    });
    
    // Gestion des animations pour les appareils mobiles
    function updateTimelineForMobile() {
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.timeline-line').forEach(line => {
                line.style.width = '4px';
                line.style.height = '0%';
                line.style.transition = 'height 1.2s ease';
                
                setTimeout(() => {
                    line.style.height = '90%';
                }, 500);
            });
        }
    }
    
    // Appel initial et écouteur pour le redimensionnement
    updateTimelineForMobile();
    window.addEventListener('resize', updateTimelineForMobile);
}); 