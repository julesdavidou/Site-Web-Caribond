<div id="chat-icon" class="chat-icon">💬</div>
<div class="chat-window" id="chat-window">
    <div class="chat-header">
        <h3>Chat avec Cari’Bot</h3>
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
            <img src="/assets/img/up-arrow.svg" alt="Envoyer">
            </button>
        </div>
        </form>
    </div>
</div>