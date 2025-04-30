<a id="android-btn" class="chat-icon" href="https://example.com" target="_blank" rel="noopener">
    <img src="assets/icons/ico-android.svg" alt="Android" />
</a>
<a id="apple-btn" class="chat-icon" href="https://example.com" target="_blank" rel="noopener">
    <img src="assets/icons/ico-apple.svg" alt="Apple" />
</a>

<div id="chat-icon" class="chat-icon">💬</div>
<div class="chat-window" id="chat-window">
    <div class="chat-header">
        <h3>Chat avec Cari’Boot</h3>
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