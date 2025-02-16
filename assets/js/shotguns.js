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