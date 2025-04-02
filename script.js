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
const menuBtn = document.querySelector('.menu-btn');
const navLinks = document.querySelector('.nav-links');
const mainNav = document.querySelector('.main-nav');

menuBtn.addEventListener('click', () => {
    menuBtn.classList.toggle('open');
    navLinks.classList.toggle('active');
});

// Animation des chiffres
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

// Initialisation des animations
document.addEventListener('DOMContentLoaded', () => {
    // Carrousel d'actualités
    let currentSlide = 0;
    const slides = document.querySelectorAll('.news-card');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach(slide => slide.style.transform = `translateX(-${index * 100}%)`);
    }

    const nextButton = document.querySelector('.next-slide');
    const prevButton = document.querySelector('.prev-slide');

    if (nextButton && prevButton) {
        nextButton.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        });

        prevButton.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        });
    }

    // Menu mobile toggle
    menuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        menuBtn.classList.toggle('active');
    });

    // Gestion des dropdowns sur mobile
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        if (window.innerWidth <= 1024) {
            dropdown.addEventListener('click', (e) => {
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                e.preventDefault();
            });
        }
    });

    // Fermer le menu mobile lors du clic sur un lien
    const navLinksItems = document.querySelectorAll('.nav-links a');
    navLinksItems.forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 1024) {
                navLinks.classList.remove('active');
                menuBtn.classList.remove('active');
            }
        });
    });

    // Animation des cartes de formation au hover
    const formationCards = document.querySelectorAll('.formation-card');
    formationCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Initialisation du mode sombre
    initDarkMode();

    // Initialisation des sections de formation
    initFormationTabs();

    // Effet de défilement pour la navigation
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            mainNav.classList.add('scrolled');
        } else {
            mainNav.classList.remove('scrolled');
        }
    });

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
});

// Gestion du mode sombre
function initDarkMode() {
    console.log('Initialisation du mode sombre...');
    const themeToggle = document.querySelector('.theme-toggle');
    console.log('Bouton trouvé:', themeToggle);
    const themeIcon = themeToggle.querySelector('i');
    console.log('Icône trouvée:', themeIcon);
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

    // Vérifie si un thème est déjà enregistré
    let currentTheme = localStorage.getItem('theme');
    console.log('Thème actuel:', currentTheme);
    
    // Applique le thème initial
    if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
        console.log('Application du thème sombre');
        document.documentElement.setAttribute('data-theme', 'dark');
        themeIcon.classList.replace('fa-moon', 'fa-sun');
        if (!currentTheme) localStorage.setItem('theme', 'dark');
    }

    // Gestion du clic sur le bouton
    themeToggle.addEventListener('click', () => {
        console.log('Clic sur le bouton de thème');
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';
        console.log('Nouveau thème:', newTheme);
        
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

// Gestion des sections de formation
function initFormationTabs() {
    const navButtons = document.querySelectorAll('.formation-nav-btn');
    const formationBlocks = document.querySelectorAll('.formation-block');

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

    // Initialiser l'affichage du premier bloc
    const firstButton = navButtons[0];
    if (firstButton) {
        firstButton.classList.add('active');
        showBlock(firstButton.dataset.section);
    }
}