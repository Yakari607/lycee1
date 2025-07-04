// Animation au défilement
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-on-scroll').forEach((el) => observer.observe(el));

document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.querySelector('.menu-btn');
    const navLinks = document.querySelector('.nav-links');
    const mainNav = document.querySelector('.main-nav');
    const menuOverlay = document.querySelector('.menu-overlay');
    
    // Menu mobile toggle
    if (menuBtn && navLinks) {
        menuBtn.addEventListener('click', () => {
            const isOpen = navLinks.classList.contains('active');
            
            menuBtn.classList.toggle('open', !isOpen);
            navLinks.classList.toggle('active', !isOpen);
            
            // Gérer l'overlay
            if (menuOverlay) {
                menuOverlay.classList.toggle('active', !isOpen);
            }
            
            // Empêcher le défilement quand le menu est ouvert
            document.body.style.overflow = !isOpen ? 'hidden' : '';
        });
        
        // Fermer le menu quand on clique sur l'overlay
        if (menuOverlay) {
            menuOverlay.addEventListener('click', () => {
                menuBtn.classList.remove('open');
                navLinks.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
        
        // Fermer le menu avec la touche Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navLinks && navLinks.classList.contains('active')) {
                menuBtn.classList.remove('open');
                navLinks.classList.remove('active');
                if (menuOverlay) {
                    menuOverlay.classList.remove('active');
                }
                document.body.style.overflow = '';
            }
        });
    }
    
    // Gestion des dropdowns sur mobile et desktop - ARIA conforme
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const dropdownTrigger = dropdown.querySelector('.dropdown-trigger') || dropdown.querySelector('a');
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        
        // Gestion clavier et souris pour les dropdowns
        function toggleDropdown(dropdown, show) {
            const isExpanded = show !== undefined ? show : !dropdown.classList.contains('active');
            const trigger = dropdown.querySelector('.dropdown-trigger') || dropdown.querySelector('a');
            const menu = dropdown.querySelector('.dropdown-menu');
            
            // Mise à jour de l'état
            dropdown.classList.toggle('active', isExpanded);
            if (trigger.setAttribute) {
                trigger.setAttribute('aria-expanded', isExpanded);
            }
            
            // Fermer les autres dropdowns
            if (isExpanded) {
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        toggleDropdown(otherDropdown, false);
                    }
                });
            }
            
            // Animation du menu
            if (isExpanded) {
                menu.style.display = 'block';
                menu.style.maxHeight = menu.scrollHeight + 'px';
            } else {
                menu.style.maxHeight = '0';
                setTimeout(() => {
                    menu.style.display = 'none';
                }, 300);
            }
        }
        
        // Événements clic et clavier
        if (dropdownTrigger) {
            dropdownTrigger.addEventListener('click', (e) => {
                e.preventDefault();
                toggleDropdown(dropdown);
            });
            
            // Navigation clavier conforme RGAA
            dropdownTrigger.addEventListener('keydown', (e) => {
                switch(e.key) {
                    case 'Enter':
                    case ' ':
                        e.preventDefault();
                        toggleDropdown(dropdown);
                        break;
                    case 'Escape':
                        e.preventDefault();
                        toggleDropdown(dropdown, false);
                        dropdownTrigger.focus();
                        break;
                    case 'ArrowDown':
                        e.preventDefault();
                        toggleDropdown(dropdown, true);
                        // Focus le premier élément du menu
                        const firstMenuItem = dropdownMenu.querySelector('a');
                        if (firstMenuItem) firstMenuItem.focus();
                        break;
                }
            });
        }
        
        // Navigation dans les menus déroulants
        const menuItems = dropdownMenu.querySelectorAll('a');
        menuItems.forEach((item, index) => {
            item.addEventListener('keydown', (e) => {
                switch(e.key) {
                    case 'Escape':
                        e.preventDefault();
                        toggleDropdown(dropdown, false);
                        dropdownTrigger.focus();
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        const prevItem = menuItems[index - 1] || menuItems[menuItems.length - 1];
                        prevItem.focus();
                        break;
                    case 'ArrowDown':
                        e.preventDefault();
                        const nextItem = menuItems[index + 1] || menuItems[0];
                        nextItem.focus();
                        break;
                }
            });
        });
    });
    
    // Fermer le menu mobile lors du clic sur un lien
    const navLinksItems = document.querySelectorAll('.nav-links a:not(.dropdown-trigger)');
    navLinksItems.forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 992 && navLinks && navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                menuBtn.classList.remove('open');
                if (menuOverlay) {
                    menuOverlay.classList.remove('active');
                }
                document.body.style.overflow = '';
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
    
    // Gestion de l'accordéon de contact - ACCESSIBLE RGAA 4
    const accordionBtn = document.querySelector('.accordion-btn');
    const accordionContent = document.querySelector('.accordion-content');
    
    if (accordionBtn && accordionContent) {
        // Gestion du clic
        accordionBtn.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Mise à jour des attributs ARIA
            this.setAttribute('aria-expanded', !isExpanded);
            this.classList.toggle('active', !isExpanded);
            accordionContent.classList.toggle('active', !isExpanded);
            
            // Animation de l'icône
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-chevron-down', isExpanded);
                icon.classList.toggle('fa-chevron-up', !isExpanded);
            }
            
            // Ajuster la hauteur pour l'animation
            if (!isExpanded) {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
            } else {
                accordionContent.style.maxHeight = '0';
            }
        });
        
        // Navigation clavier
        accordionBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
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
    
    // NOUVEAU SLIDER ACTUALITÉS - Simple et fonctionnel
    const newsGrid = document.querySelector('.news-grid');
    const newsCards = document.querySelectorAll('.news-card');
    const sliderNavPrev = document.querySelector('.slider-nav.prev');
    const sliderNavNext = document.querySelector('.slider-nav.next');

    if (newsGrid && newsCards.length > 0 && sliderNavPrev && sliderNavNext) {
        let currentIndex = 0;
        
        // Centrage automatique si 1 ou 2 actualités
        if (newsCards.length <= 2) {
            newsGrid.classList.add('centered');
        } else {
            newsGrid.classList.remove('centered');
        }
        
        // NOUVEAU CALCUL MOBILE - Simple et efficace
        function getVisibleCards() {
            if (window.innerWidth <= 576) {
                // Mobile : TOUJOURS 1 seule carte
                return 1;
            } else if (window.innerWidth <= 768) {
                // Tablette : TOUJOURS 1 seule carte
                return 1;
            } else if (window.innerWidth <= 992) {
                // Petit desktop : 2-3 cartes
                return Math.min(3, newsCards.length);
            } else {
                // Grand écran : calcul automatique
                const container = document.querySelector('.news-slider-container');
                const containerWidth = container.offsetWidth - 120;
                const cardWidth = 320;
                const gap = 24;
                const cardsPerView = Math.floor((containerWidth + gap) / (cardWidth + gap));
                return Math.max(1, Math.min(cardsPerView, newsCards.length));
            }
        }
        
        function updateSlider() {
            const visibleCards = getVisibleCards();
            const maxIndex = newsCards.length - visibleCards;
            
            // Limiter l'index
            currentIndex = Math.max(0, Math.min(currentIndex, maxIndex));
            
            // NOUVEAU CALCUL MOBILE - Ultra simple
            let cardWidth, gap, translateX;
            
            if (window.innerWidth <= 576) {
                // Mobile : largeur dynamique basée sur l'écran
                cardWidth = Math.min(280, window.innerWidth - 130);
                gap = 16;
                translateX = -(currentIndex * (cardWidth + gap));
            } else if (window.innerWidth <= 768) {
                // Tablette : carte fixe
                cardWidth = 300;
                gap = 24;
                translateX = -(currentIndex * (cardWidth + gap));
            } else {
                // Desktop : calcul normal
                cardWidth = 320;
                gap = 24;
                translateX = -(currentIndex * (cardWidth + gap));
            }
            
            newsGrid.style.transform = `translateX(${translateX}px)`;
            
            // Gestion des boutons - Simple
            const shouldShowButtons = newsCards.length > 1;
            
            if (shouldShowButtons) {
                sliderNavPrev.style.display = 'flex';
                sliderNavNext.style.display = 'flex';
                
                sliderNavPrev.disabled = currentIndex === 0;
                sliderNavNext.disabled = currentIndex >= maxIndex;
            } else {
                sliderNavPrev.style.display = 'none';
                sliderNavNext.style.display = 'none';
            }
            
            // Debug simple
            console.log('Slider:', { currentIndex, maxIndex, translateX, cardWidth, screenWidth: window.innerWidth });
        }
        
        // Navigation
        sliderNavPrev.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });
        
        sliderNavNext.addEventListener('click', () => {
            const visibleCards = getVisibleCards();
            const maxIndex = newsCards.length - visibleCards;
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });
        
        // Support tactile simple
        let startX = 0;
        let isDragging = false;
        
        newsGrid.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
        });
        
        newsGrid.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            
            const endX = e.changedTouches[0].clientX;
            const deltaX = startX - endX;
            
            if (Math.abs(deltaX) > 50) {
                if (deltaX > 0) {
                    // Swipe vers la gauche - slide suivant
                    sliderNavNext.click();
                } else {
                    // Swipe vers la droite - slide précédent
                    sliderNavPrev.click();
                }
            }
            
            isDragging = false;
        });
        
        // Initialisation
        updateSlider();
        
        // Redimensionnement
        window.addEventListener('resize', () => {
            setTimeout(updateSlider, 100);
        });
    }

    // === Carrousel d'images actualité ===
    var carousel = document.querySelector('.actualite-carousel');
    if (!carousel) return;
    var slides = carousel.querySelectorAll('.carousel-slide');
    var prevBtn = carousel.querySelector('.carousel-prev');
    var nextBtn = carousel.querySelector('.carousel-next');
    var pagination = carousel.querySelector('.carousel-pagination');
    var current = 0;
    var total = slides.length;

    // Crée la pagination
    if (pagination) {
        for (let i = 0; i < total; i++) {
            let dot = document.createElement('span');
            dot.className = 'carousel-pagination-dot' + (i === 0 ? ' active' : '');
            dot.setAttribute('data-index', i);
            dot.addEventListener('click', function() {
                showSlide(i);
            });
            pagination.appendChild(dot);
        }
    }

    function showSlide(idx) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === idx);
        });
        var dots = carousel.querySelectorAll('.carousel-pagination-dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === idx);
        });
        current = idx;
    }

    function prevSlide() {
        showSlide((current - 1 + total) % total);
    }
    function nextSlide() {
        showSlide((current + 1) % total);
    }

    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);

    // Affiche la première slide
    showSlide(0);
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
if (numbersSection) {s
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
        button.addEventListener('click', (e) => {
            // Empêcher le comportement de lien par défaut
            e.preventDefault();
            
            // Retirer la classe active de tous les boutons
            navButtons.forEach(btn => btn.classList.remove('active'));
            
            // Ajouter la classe active au bouton cliqué
            button.classList.add('active');

            // Afficher le bloc correspondant
            const targetSection = button.dataset.section;
            showBlock(targetSection);

            // Faire défiler jusqu'à la section
            const formationsSection = document.querySelector('.filiere-section');
            if (formationsSection) {
                formationsSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Initialiser l'affichage du bon bloc selon le bouton actif
    const activeButton = document.querySelector('.formation-nav-btn.active');
    if (activeButton) {
        const targetSection = activeButton.dataset.section;
        showBlock(targetSection);
    } else if (navButtons.length > 0) {
        // Fallback sur le premier bouton si aucun n'est actif
        const firstButton = navButtons[0];
        firstButton.classList.add('active');
        const targetSection = firstButton.dataset.section;
        showBlock(targetSection);
    }
}
