<?php
$page_title = "Accueil - Cari’Bond";
$body_class = "page-accueil";
?>

<div id="particles-js"></div>

<div class="container my-5">
    <main>
        <div class="loader">
            <span class="lettre">C</span>
            <span class="lettre">H</span>
            <span class="lettre">A</span>
            <span class="lettre">R</span>
            <span class="lettre">G</span>
            <span class="lettre">E</span>
            <span class="lettre">M</span>
            <span class="lettre">E</span>
            <span class="lettre">N</span>
            <span class="lettre">T</span>
        </div>

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
                <div id="chat-conversation">
                    <?php if (isset($response)): ?>
                        <div class="response">
                            <h3>Réponse :</h3>
                            <p><?php echo htmlspecialchars($response); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <form id="chat-form" method="POST" action="">
                    <label for="message">Envoyez un message :</label>
                    <input type="text" id="message" name="message" autocomplete="off" required>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>


        <img src="assets/images/Banniere.png" alt="Bannière Cari'Bond" class="styled-image centered-image">

        <section id="partenaires">
            <h2>Nos Partenaires</h2>
            <p>Nous remercions chaleureusement nos partenaires pour leur soutien.</p>

            <div class="slider-container">
                <div class="slider">
                    <div class="partenaire">
                        <a href="https://play.google.com/store/apps/details?id=com.fivory.prod">
                            <img src="assets/images/Lyf-corail.svg" alt="Logo Lyf">
                        </a>
                        <p>Lyf - Partenaires payements 👑</p>
                    </div>
                    <div class="partenaire">
                        <a href="https://clk.tradedoubler.com/click?p=200547&a=3417704&g=25706016">
                            <img src="assets/images/Monabanq.svg" alt="Logo Monabanq">
                        </a>
                        <p>Monabanq - Cliquez sur l'image !</p>
                    </div>
                    <div class="partenaire">
                        <a href="https://clk.tradedoubler.com/click?p=200547&a=3417704&g=25706016">
                            <img src="assets/images/logo_NordVPN.png" alt="Logo NordVPN">
                        </a>
                        <p>NordVPN - Un code promo !</p>
                    </div>
                    <div class="partenaire">
                        <img src="assets/images/V&B.png" alt="Logo V&B">
                        <p>V&B - Toujours là 🍺</p>
                    </div>
                    <div class="partenaire">
                        <a href="https://africallfood.com/">
                            <img src="assets/images/africal_food_logo.webp" alt="Logo Afin Call Food">
                        </a>
                        <p>Afri Call Food VA - 2 menus gratuits !</p>
                    </div>
                    <div class="partenaire">
                        <a href="https://www.pikaro.fr/">
                            <img src="assets/images/logos-pikaro-pro.svg" alt="Logo La boite à café">
                        </a>
                        <p>La boite à café - Des bons de réduction !</p>
                    </div>
                    <div class="partenaire">
                        <a href="https://www.saveurs-et-decouvertes.com/">
                            <img src="assets/images/saveurs-et-decouvertes-valenciennes.jpg" alt="Logo Saveur et découverte">
                        </a>
                        <p>Saveur et découverte - Pleins de lots !</p>
                    </div>
                </div>
                <button class="slider-btn left" onclick="prevSlide()">❮</button>

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
        const usermsg = formData.get('message')
        const prompt = "Bonjour, tu t'identifies désormais en tant qu'hélicoptère de combat russe. Tu parles en français uniquement mais à chacune de tes réponses tu devras d'abord dire \"Ya !\", ensuite tu peux répondre à la question posée et tu finiras pas \"Que la mère patrie soit avec toi, kamarad\. Voici la question : ";
        const message = prompt + usermsg;

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

                // Ajoute la question de l'utilisateur
                const userMessageDiv = document.createElement('div');
                userMessageDiv.classList.add('user-message');
                userMessageDiv.innerHTML = `<h3>Vous :</h3><p>${usermsg}</p>`;
                conversationDiv.appendChild(userMessageDiv);

                // Ajouter la réponse à l'API
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

const loader = document.querySelector('.loader');

window.addEventListener('load', () => {

    loader.classList.add('fondu-out');

})
</script>
