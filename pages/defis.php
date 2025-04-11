<?php
$page_title = "Divisions - Cari’Bond";
$body_class = "page-divisions";
?>

<div id="particles-js"></div>
<div class="container my-5">
    <main>
        <h1>Défis</h1>

        <div class="telechargement_passport">
            <a href="URL_DE_DESTINATION" style="text-decoration: none; color: #1e2a50;">
            <p>Téléchargez et imprimez votre passeport !</p>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#1e2a50">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
            </a>
        </div>

        <div class="defis">
            <div class="gallery">
                <ul class="cards">

                    <?php for ($i = 1; $i <= 40; $i++): ?>
                        <li class="card"><img src="assets/images/defi<?php echo $i; ?>.svg" alt="Image <?php echo $i; ?>"></li>
                    <?php endfor; ?>


                </ul>
            </div>
            <div class="actions">
                <button class="prev">&#x25C0; Prev</button>
                <button class="next">Next &#x25B6;</button>
            </div>

        </div>

        <div class="defi-remplissage">
            <!--Ceci est un div pour que le footer ne soit pas sous les cartes -->
        </div>

        <!-- sans titre masi pas ajusté -->
        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTQibCxBsDaviPDbL-b8yqpAcfFDmgyf0sNVB4aTMpL9BLcnDbbmomQGPcbqWhN40FwPntpjaAJXb8J/pubhtml?gid=870713603&single=true&widget=true&headers=false&chrome=false"></iframe>

    </main>
</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js"></script>
<script src="assets/js/scrollDefis.js"></script>

<!-- Inclure les plugins nécessaires via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/DrawSVGPlugin.min.js"></script>

<script src="assets/js/animationTelechargement.js"></script>



