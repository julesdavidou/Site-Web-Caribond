<?php
$page_title = "Accueil - Cari’Bond";
$body_class = "page-accueil";
?>

<div id="particles-js"></div>

<div class="container my-5">
    <main>
        <h1>Bienvenue chez Cari’Bond</h1>
        <p>Ceci est le début de votre mission. Explorez nos différentes pages et découvrez les secrets des agents Cari’Bond !</p>

        <img src="assets/images/Banniere.png" alt="Bannière Cari'Bond" class="styled-image centered-image">

        <section id="partenaires">
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
                    <div class="partenaire">
                        <img src="assets/images/partenaire.jpg" alt="Partenaire 4">
                        <p>Partenaire 4</p>
                    </div>
                    <div class="partenaire">
                        <img src="assets/images/partenaire.jpg" alt="Partenaire 5">
                        <p>Partenaire 5</p>
                    </div>
                </div>
                <button class="slider-btn right" onclick="nextSlide()">❯</button>
            </div>
        </section>
    </main>
</div>