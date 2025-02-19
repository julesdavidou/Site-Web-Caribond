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
        <div id="chat-window" class="chat-window">
            <div class="chat-header">
                <h3>Chat avec Cari’Bond</h3>
                <span id="close-chat" class="close-chat">&times;</span>
            </div>
            <div class="chat-body">
                <form id="chat-form" method="POST" action="">
                    <label for="message">Envoyez un message :</label>
                    <input type="text" id="message" name="message" required>
                    <button type="submit">Envoyer</button>
                </form>
                <div id="chat-conversation">
                    <?php if (isset($response)): ?>
                        <div class="response">
                            <h3>Réponse :</h3>
                            <p><?php echo htmlspecialchars($response); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


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

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('chat-icon').addEventListener('click', function() {
        document.getElementById('chat-window').style.display = 'flex';
    });

    document.getElementById('close-chat').addEventListener('click', function() {
        document.getElementById('chat-window').style.display = 'none';
    });

    document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const formData = new FormData(this);
        const message = formData.get('message');

        fetch('ajax_handler.php', { // Utilise le chemin relatif du fichier PHP pour les requêtes AJAX
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest' // Ajoute l'en-tête pour indiquer une requête AJAX
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => {
            console.log('Réponse brute :', response); // Ajoute un log de débogage
            return response.text(); // Lis la réponse en tant que texte brut
        })
        .then(text => {
            console.log('Texte de la réponse :', text); // Ajoute un log de débogage
            try {
                const data = JSON.parse(text);
                const conversationDiv = document.getElementById('chat-conversation');
                const responseDiv = document.createElement('div');
                responseDiv.classList.add('response');
                responseDiv.innerHTML = `<h3>Réponse :</h3><p>${data.response}</p>`;
                conversationDiv.appendChild(responseDiv);
                this.reset(); // Réinitialise le formulaire
            } catch (error) {
                console.error('Erreur lors de la conversion JSON :', error);
            }
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    });
});
</script>
