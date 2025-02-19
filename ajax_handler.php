<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lire les données JSON envoyées
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['message'])) {
        $message = $data['message'];
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
            echo json_encode(['response' => $response]);
        } else {
            echo json_encode(['error' => 'Erreur lors de l\'envoi du message. Code HTTP: ' . $httpCode]);
        }

        curl_close($ch);
    } else {
        echo json_encode(['error' => 'Le message est manquant dans la requête.']);
    }

    exit(); // Arrête l'exécution du script après avoir renvoyé la réponse JSON
}
?>
