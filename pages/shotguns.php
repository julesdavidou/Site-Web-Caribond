<?php
$page_title = "Shotguns - Cari’Bond";
$body_class = "page-shotguns";
?>

<div id="particles-js"></div>

<div class="container my-5">
    <main>
        <h1>🔫Shotguns</h1>

    <div class="category">
        <h2>Activités du Midi</h2>
        <div class="activity" data-start="2025-02-07T12:00:00" data-end="2026-02-10T14:00:00" data-link="https://docs.google.com/forms/d/e/1FAIpQLSejsvXM-okwCby0qIw7XExhBZCSjBiEBgYA49OMZZxuzh1Blg/viewform?embedded=true">
            <iframe id="form-midi" src="#" width="640" height="381" frameborder="0" marginheight="0" marginwidth="0" class="hidden"></iframe>
            <div class="text-placeholder hidden">Le formulaire n'est pas disponible pour le moment.</div>
        </div>
    </div>

    <div class="category">
        <h2>Activités de l'Après-midi</h2>
        <div class="activity" data-start="2025-02-07T12:00:00" data-end="2026-02-10T14:00:00" data-link="https://docs.google.com/forms/d/e/1FAIpQLSc5m1LdwWVRaOUrTO6LgAaZxObufIvQnZu7vJMNg1a6KnoENw/viewform?embedded=true">
            <iframe id="form-apresmidi" src="#" width="640" height="381" frameborder="0" marginheight="0" marginwidth="0" class="hidden"></iframe>
            <div class="text-placeholder hidden">Le formulaire n'est pas disponible pour le moment.</div>
        </div>
    </div>

    <div class="category">
        <h2>Activités du Soir</h2>
        <div class="activity" data-start="2025-02-07T20:00:00" data-end="2026-02-10T22:00:00" data-link="https://forms.gle/formulaire3" data-closed="true">
            <a href="#">Soirée jeux de société</a>
            <div class="text-placeholder hidden">Le formulaire n'est pas disponible pour le moment.</div>
        </div>
    </div>


        <script src="assets/js/shotguns.js"></script>
        
    </main> 
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const activities = document.querySelectorAll('.activity');

    activities.forEach(activityDiv => {
        const startDate = new Date(activityDiv.getAttribute('data-start'));
        const endDate = new Date(activityDiv.getAttribute('data-end'));
        const currentDate = new Date();
        const iframeContainer = activityDiv.querySelector('.iframe-container');
        const textPlaceholder = activityDiv.querySelector('.text-placeholder');
        const iframe = document.createElement('iframe');

        if (currentDate >= startDate && currentDate <= endDate) {
            iframe.src = activityDiv.getAttribute('data-link');
            iframe.width = "640";
            iframe.height = "381";
            iframe.frameborder = "0";
            iframe.marginheight = "0";
            iframe.marginwidth = "0";
            iframeContainer.appendChild(iframe);
            textPlaceholder.classList.add('hidden');
        } else {
            textPlaceholder.classList.remove('hidden');
        }
    });
});
</script>
