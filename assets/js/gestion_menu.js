document.addEventListener('DOMContentLoaded', function() {
    var theToggle = document.querySelector('.slicknav_btn');
    var navMenu = document.querySelector('.slicknav_menu');

    if (theToggle && navMenu) {
        theToggle.addEventListener('click', function(event) {
            event.stopPropagation(); // Empêche la propagation du clic pour éviter de fermer immédiatement le menu
            navMenu.classList.toggle('active');
            this.classList.toggle('slicknav_open');
        });

        // Ajouter un gestionnaire d'événements pour détecter les clics en dehors du menu
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = navMenu.contains(event.target) || theToggle.contains(event.target);

            if (!isClickInsideMenu && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                theToggle.classList.remove('slicknav_open');
            }
        });
    } else {
        console.error('Élément non trouvé :', { theToggle, navMenu });
    }
});


/*document.addEventListener('DOMContentLoaded', function() {
    var theToggle = document.querySelector('.slicknav_btn');
    var navMenu = document.querySelector('.slicknav_menu');

    if (theToggle && navMenu) {
        theToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            this.classList.toggle('slicknav_open');
        });
    } else {
        console.error('Élément non trouvé :', { theToggle, navMenu });
    }
});
*/