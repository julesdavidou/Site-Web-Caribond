<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cari’Bond</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="page-accueil">

<div id="particles-js"></div>

<!-- HEADER -->
<header>
    <nav>
        <ul>
            <li><a href="index.php?page=accueil">Accueil</a></li>
            <li><a href="index.php?page=programme">Programme</a></li>
            <li><a href="index.php?page=divisions">Divisions</a></li>
            <li><a href="index.php?page=shotguns">Shotguns</a></li>
            <li><a href="index.php?page=productions">Productions</a></li>
            <li><a href="index.php?page=taxis">Taxis</a></li>
        </ul>
    </nav>
</header>

<div class="container my-5">
    <main>
        <h1>Bienvenue chez Cari’Bond</h1>
        <p>Ceci est le début de votre mission. Explorez nos différentes pages et découvrez les secrets des agents Cari’Bond !</p>

        <!-- Image intégrée avec style -->
        <img src="assets/images/totally_spies.webp" alt="Totally Spies" class="styled-image centered-image">

        <!-- Slider partenaires -->
        <section id="partenaires" class="mt-5">
            <h2>Nos Partenaires</h2>
            <p>Nous remercions chaleureusement nos partenaires pour leur soutien.</p>
            <div class="slider-container">
                <button class="slider-btn left" onclick="prevSlide()">❮</button>
                <div class="slider">
                    <div class="partenaire">
                        <img src="assets/images/LyfPay.png" alt="Logo LyfPay">
                        <p>LyfPay - Les rois 👑</p>
                    </div>
                    <div class="partenaire">
                        <img src="assets/images/V&B.png" alt="Logo V&B">
                        <p>V&B - Toujours là 🍺</p>
                    </div>
                    <div class="partenaire">
                        <img src="assets/images/VUC.webp" alt="Logo VUC">
                        <p>VUC - Innovateurs 🏀</p>
                    </div>
                </div>
                <button class="slider-btn right" onclick="nextSlide()">❯</button>
            </div>
        </section>
    </main>
</div>

<!-- FOOTER -->
<footer>
    <p>&copy; 2025 Cari’Bond - Tous droits réservés</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Charger le fichier local -->
<script src="assets/js/particles.min.js"></script>

<!-- Initialisation de Particles.js -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    particlesJS("particles-js", {
        particles: {
            number: {
                value: 75,
                density: { enable: true, value_area: 800 }
            },
            color: { value: "#7598ff" },
            shape: { type: "circle" },
            opacity: { value: 0.3, random: true },
            size: { value: 3, random: true },
            line_linked: {
                enable: true,
                distance: 250,
                color: "#7598ff",
                opacity: 0.2,
                width: 0.4
            },
            move: {
                enable: true,
                speed: 1.0,
                direction: "none",
                random: false,
                straight: false,
                out_mode: "out",
                bounce: false
            }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: { enable: true, mode: "grab" },
                onclick: { enable: true, mode: "push" }
            },
            modes: {
                grab: { distance: 140, line_linked: { opacity: 1 } },
                push: { particles_nb: 4 }
            }
        },
        retina_detect: true
    });
});
</script>


</body>
</html>
