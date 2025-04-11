<?php
$page_title = "Accueil - Cari’Bond";
$body_class = "page-accueil";
?>

<div id="particles-js"></div>

<div class="container my-5">
    <main>
        <h1>Bienvenue chez Cari’Bond</h1>
        <p>Ceci est le début de votre mission. Explorez nos différentes pages et découvrez les secrets des agents Cari’Bond !</p>

        <!-- Chat Icon and Window -->
        <div id="chat-icon" class="chat-icon">💬</div>
        <div class="chat-window" id="chat-window">
            <div class="chat-header">
                <h3>Chat avec Cari’Bond</h3>
                <span id="close-chat" class="close-chat">&times;</span>
            </div>
            <div id="chat-body" class="chat-body">
                <div id="chat-conversation">
                    <!-- Messages s'affichent ici -->
                    <?php if (isset($response)): ?>
                    <div class="response">
                        <h3>Réponse :</h3>
                        <p><?php echo htmlspecialchars($response); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="chat-footer">
                <form id="chat-form" method="POST" action="">
                <div class="input-group">
                    <input type="text" id="message" name="message" placeholder="Envoyez un message" autocomplete="off" required>
                    <button type="submit" class="send-button">
                    <img src="assets/images/up-arrow.svg" alt="Envoyer">
                    </button>
                </div>
                </form>
            </div>
        </div>

        <img src="assets/images/Bannière_test.webp" alt="Bannière Cari'Bond" class="styled-image centered-image">

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

<script src='includes/chat.js'></script>
