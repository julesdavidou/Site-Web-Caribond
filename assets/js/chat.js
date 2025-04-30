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

    const chatIcon = document.getElementById('chat-icon');
    const chatWindow = document.getElementById('chat-window');
    const closeChat = document.getElementById('close-chat');

    const chatConversation = document.getElementById("chat-conversation");
    // bascule d'ouverture/fermeture
    chatIcon.addEventListener('click', function() {
        if (chatWindow.classList.contains('open')) {
            // Fermer la fenêtre
            chatWindow.classList.remove('open');
            setTimeout(() => {
                chatWindow.style.display = 'none';
            }, 300); // correspond au temps de transition CSS
        } else {
            // Ouvrir la fenêtre
            chatWindow.style.display = 'flex';
            setTimeout(() => {
                chatWindow.classList.add('open');
            }, 10); // petit délai pour déclencher la transition
        }
    });
    
    closeChat.addEventListener('click', function() {
        chatWindow.classList.remove('open');
        setTimeout(() => {
            chatWindow.style.display = 'none';
        }, 300); // Doit correspondre à la durée de transition CSS
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
                responseDiv.innerHTML = `<div class="labelReponse">Cari’Boot</div><p>${data.response}</p>`;
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