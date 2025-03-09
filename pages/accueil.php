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
    const messageInput = document.getElementById("message");
    const sendButton = document.querySelector(".send-button");

    messageInput.addEventListener("input", () => {
        if (messageInput.value.trim() !== "") {
            sendButton.classList.add("active");
        } else {
            sendButton.classList.remove("active");
        }
    });

    const chatConversation = document.getElementById("chat-conversation");
    document.getElementById('chat-icon').addEventListener('click', function() {
        document.getElementById('chat-window').style.display = 'flex';
    });

    document.getElementById('close-chat').addEventListener('click', function() {
        document.getElementById('chat-window').style.display = 'none';
    });

    document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        const chatBody = document.getElementById("chat-body");
        const chatLoader = document.createElement('div');
        chatLoader.classList.add('chat-loader');

        // Permet de faire en sorte que le bouton d'envoi redevienne inactif
        sendButton.classList.remove("active");

        // Pas besoin de .id.add(), c'est une propriété :
        chatLoader.id = 'chat-loader'; 

        chatLoader.innerHTML = `<div class="spinner"></div>`;
        chatBody.appendChild(chatLoader);

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

                 // Après réception de la réponse de l'IA
                chatLoader.remove();

                // Ajoute la question de l'utilisateur
                const userMessageDiv = document.createElement('div');
                userMessageDiv.classList.add('user-message');
                userMessageDiv.innerHTML = `<div class="labelMessage">Vous</div><p>${usermsg}</p>`;
                conversationDiv.appendChild(userMessageDiv);

                // Ajouter la réponse à l'API
                const responseDiv = document.createElement('div');
                responseDiv.classList.add('response');
                responseDiv.innerHTML = `<div class="labelReponse">Caribot</div><p>${data.response}</p>`;
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
