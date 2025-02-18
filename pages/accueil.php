<?php
$page_title = "Accueil - Cari’Bond";
$body_class = "page-accueil";

$response = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $apiKey = '3IUaBHrwC6R8iRyNrGaKMQHJrPv1YI9f';
    $apiUrl = 'https://api.mistral.ai/v1/chat/completions';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'model' => 'mistral-large-latest',
        'messages' => [['role' => 'user', 'content' => $message]]
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode === 200) {
        $responseData = json_decode($response, true);
        $response = $responseData['choices'][0]['message']['content'];
    } else {
        $response = 'Erreur lors de l\'envoi du message. Code HTTP: ' . $httpCode;
    }

    curl_close($ch);
}
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

        <section id="chat">
            <h2>Chat avec Cari’Bond</h2>
            <form method="POST" action="">
                <label for="message">Envoyez un message :</label>
                <input type="text" id="message" name="message" required>
                <button type="submit">Envoyer</button>
            </form>

            <?php if (isset($response)): ?>
                <div class="response">
                    <h3>Réponse :</h3>
                    <p><?php echo htmlspecialchars($response); ?></p>
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>
