<!DOCTYPE html>
<html lang="fr">
<body>
    <!-- Loader -->
    <div id="site-loader">
        <img src="assets/images/logo_Caribond.svg" alt="Chargement" id="loader-image">
        <p>Chargement en cours...</p>
    </div>

    <!-- Ton contenu de page ici -->

    <!-- Script pour le loader -->
    <script>
    window.addEventListener("load", function () {
        const loader = document.getElementById("site-loader");
        loader.style.opacity = "0";
        loader.style.transition = "opacity 0.5s ease";

        setTimeout(() => {
            loader.style.display = "none";
        }, 500);
    });
    </script>
</body>
</html>
