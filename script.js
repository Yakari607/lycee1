// Animation au défilement
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-on-scroll').forEach((el) => observer.observe(el));

// Menu hamburger pour mobile
document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.querySelector('.menu-btn');
    const navLinks = document.querySelector('.nav-links');
    const mainNav = document.querySelector('.main-nav');
    
    // Menu mobile toggle
    if (menuBtn) {
        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('open');
            navLinks.classList.toggle('active');
        });
    }
    
    // Gestion des dropdowns sur mobile et desktop
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const dropdownLink = dropdown.querySelector('a');
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        
        // Sur mobile
        if (window.innerWidth <= 992) {
            dropdownLink.addEventListener('click', (e) => {
                e.preventDefault();
                dropdown.classList.toggle('active');
                
                // Ferme tous les autres dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('active');
                    }
                });
                
                // Toggle l'affichage du menu
                if (dropdown.classList.contains('active')) {
                    dropdownMenu.style.display = 'block';
                    dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + 'px';
                } else {
                    dropdownMenu.style.maxHeight = '0';
                    setTimeout(() => {
                        dropdownMenu.style.display = 'none';
                    }, 300);
                }
            });
        }
    });
    
    // Fermer le menu mobile lors du clic sur un lien
    const navLinksItems = document.querySelectorAll('.nav-links a:not(.dropdown > a)');
    navLinksItems.forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 992 && !item.parentElement.classList.contains('dropdown')) {
                navLinks.classList.remove('active');
                menuBtn.classList.remove('open');
            }
        });
    });
    
    // Effet de défilement pour la navigation
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            mainNav.classList.add('scrolled');
        } else {
            mainNav.classList.remove('scrolled');
        }
    });
    
    // Initialisation du mode sombre
    initDarkMode();
    
    // Initialisation des sections de formation
    initFormationTabs();
    
    // Gestion de l'accordéon de contact
    const accordionBtn = document.querySelector('.accordion-btn');
    const accordionContent = document.querySelector('.accordion-content');
    
    if (accordionBtn && accordionContent) {
        accordionBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            accordionContent.classList.toggle('active');
            
            // Ajuster la hauteur maximale pour l'animation
            if (accordionContent.classList.contains('active')) {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
            } else {
                accordionContent.style.maxHeight = '0';
            }
        });
    }
    
    // Animation des cartes au hover
    const formationCards = document.querySelectorAll('.formation-card, .news-card, .filiere-card, .langue-card, .diplome-card');
    formationCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = 'var(--card-shadow-hover)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = 'var(--card-shadow)';
        });
    });
    
    // Carrousel d'actualités avec les flèches
    const sliderNavPrev = document.querySelector('.slider-nav.prev');
    const sliderNavNext = document.querySelector('.slider-nav.next');
    const newsGrid = document.querySelector('.news-grid');
    
    if (sliderNavPrev && sliderNavNext && newsGrid) {
        const newsCards = newsGrid.querySelectorAll('.news-card');
        let currentIndex = 0;
        const cardWidth = newsCards.length > 0 ? newsCards[0].offsetWidth : 0;
        const cardMargin = 20; // Marge entre les cartes
        
        // Fonction pour faire défiler les cartes
        const scrollCards = (direction) => {
            if (direction === 'next' && currentIndex < newsCards.length - 1) {
                currentIndex++;
            } else if (direction === 'prev' && currentIndex > 0) {
                currentIndex--;
            }
            
            const translateValue = currentIndex * -(cardWidth + cardMargin);
            newsGrid.style.transform = `translateX(${translateValue}px)`;
        };
        
        sliderNavPrev.addEventListener('click', () => scrollCards('prev'));
        sliderNavNext.addEventListener('click', () => scrollCards('next'));
    }
});

// Animation des nombres
function animateNumbers() {
    const numberElements = document.querySelectorAll('.number');
    
    numberElements.forEach(number => {
        const targetNumber = parseInt(number.textContent);
        let currentNumber = 0;
        const duration = 2000; // 2 secondes
        const increment = targetNumber / (duration / 16); // 60 FPS

        function updateNumber() {
            if (currentNumber < targetNumber) {
                currentNumber += increment;
                number.textContent = Math.round(currentNumber);
                requestAnimationFrame(updateNumber);
            } else {
                number.textContent = targetNumber;
            }
        }

        updateNumber();
    });
}

// Lance l'animation des nombres quand ils sont visibles
const numberObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateNumbers();
            numberObserver.unobserve(entry.target);
        }
    });
});

const numbersSection = document.querySelector('.numbers-grid');
if (numbersSection) {
    numberObserver.observe(numbersSection);
}
// Gestion du mode sombre
function initDarkMode() {
    const themeToggle = document.querySelector('.theme-toggle');
    if (!themeToggle) return;
    
    const themeIcon = themeToggle.querySelector('i');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

    // Vérifie si un thème est déjà enregistré
    let currentTheme = localStorage.getItem('theme');
    
    // Applique le thème initial
    if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
        document.documentElement.setAttribute('data-theme', 'dark');
        themeIcon.classList.replace('fa-moon', 'fa-sun');
        if (!currentTheme) localStorage.setItem('theme', 'dark');
    }

    // Gestion du clic sur le bouton
    themeToggle.addEventListener('click', () => {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Change l'icône
        if (newTheme === 'dark') {
            themeIcon.classList.replace('fa-moon', 'fa-sun');
        } else {
            themeIcon.classList.replace('fa-sun', 'fa-moon');
        }
    });
}

// Gestion des sections de formation
function initFormationTabs() {
    const navButtons = document.querySelectorAll('.formation-nav-btn');
    const formationBlocks = document.querySelectorAll('.formation-block');
    
    if (navButtons.length === 0 || formationBlocks.length === 0) return;

    // Fonction pour afficher un bloc spécifique
    function showBlock(blockId) {
        // Masquer tous les blocs avec une animation de fade out
        formationBlocks.forEach(block => {
            block.style.opacity = '0';
            block.classList.remove('active');
            setTimeout(() => {
                block.style.display = 'none';
            }, 300);
        });

        // Afficher le bloc sélectionné avec une animation de fade in
        const targetBlock = document.getElementById(blockId);
        if (!targetBlock) return;
        
        setTimeout(() => {
            targetBlock.style.display = 'block';
            targetBlock.classList.add('active');
            setTimeout(() => {
                targetBlock.style.opacity = '1';
            }, 50);
        }, 300);
    }

    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Retirer la classe active de tous les boutons
            navButtons.forEach(btn => btn.classList.remove('active'));
            
            // Ajouter la classe active au bouton cliqué
            button.classList.add('active');

            // Afficher le bloc correspondant
            const targetSection = button.dataset.section;
            showBlock(targetSection);

            // Faire défiler jusqu'à la section
            const formationsSection = document.querySelector('.formations-section');
            formationsSection.scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Initialiser l'affichage du premier bloc si aucun n'est actif
    if (!document.querySelector('.formation-block.active') && navButtons.length > 0) {
        const firstButton = navButtons[0];
        firstButton.classList.add('active');
        const targetSection = firstButton.dataset.section;
        showBlock(targetSection);
    }
}
