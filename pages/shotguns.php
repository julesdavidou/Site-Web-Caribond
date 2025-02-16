<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cari’Bond</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="shotguns">
    <!-- Header -->
    <header>
        <nav>
            <ul>
            <li><a href="index.php?page=accueil">Accueil</a></li>
            <li><a href="index.php?page=programme">Programme</a></li>
            <li><a href="index.php?page=divisions">Divisions</a></li>
            <li><a href="index.php?page=shotguns">Shotguns</a></li>
            <li><a href="index.php?page=productions">Productions</a></li>
            <li><a href="index.php?page=taxis">Taxis</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>🔫Shotguns</h1>

        <div class="category">
            <h2>Activités du Midi</h2>
            <div class="activity" data-start="2025-02-07T12:00:00" data-end="2025-02-10T14:00:00" data-link="https://docs.google.com/forms/d/e/1FAIpQLSejsvXM-okwCby0qIw7XExhBZCSjBiEBgYA49OMZZxuzh1Blg/viewform?embedded=true">
                <iframe id="form-midi" src="#" width="640" height="381" frameborder="0" marginheight="0" marginwidth="0" class="hidden">Chargement…</iframe>
            </div>
        </div>
    
        <div class="category">
            <h2>Activités de l'Après-midi</h2>
            <div class="activity" data-start="2025-02-07T12:00:00" data-end="2025-02-10T14:00:00" data-link="https://docs.google.com/forms/d/e/1FAIpQLSc5m1LdwWVRaOUrTO6LgAaZxObufIvQnZu7vJMNg1a6KnoENw/viewform?embedded=true">
                <iframe id="form-apresmidi" src="#" width="640" height="381" frameborder="0" marginheight="0" marginwidth="0" class="hidden">Chargement…</iframe>
            </div>
        </div>
    
        <div class="category">
            <h2>Activités du Soir</h2>
            <div class="activity" data-start="2025-02-07T20:00:00" data-end="2025-02-10T22:00:00" data-link="https://forms.gle/formulaire3" data-closed="true">
                <a href="#">Soirée jeux de société</a>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const activities = document.querySelectorAll(".activity");

                activities.forEach(activity => {
                    const startTime = new Date(activity.getAttribute("data-start"));
                    const endTime = new Date(activity.getAttribute("data-end"));
                    const now = new Date();
                    const iframe = activity.querySelector("iframe");
                    const url = activity.getAttribute("data-link");
                    const isManuallyClosed = activity.getAttribute("data-closed") === "true";

                    if (iframe) {
                        if (isManuallyClosed || now >= endTime) {
                            activity.classList.add("closed");
                        } else if (now >= startTime) {
                            iframe.src = url; // Charge le formulaire seulement quand l'heure est atteinte
                            iframe.classList.remove("hidden"); // Affiche l'iframe
                        }
                    }
                });
            });
        </script> 
    </main> 
    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Cari’Bond - Tous droits réservés</p>
    </footer>
</body>
</html>
