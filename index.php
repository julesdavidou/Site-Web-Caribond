<?php 
    $pageTitle = "Accueil - Caribond";
    $link = "accueil";
    include 'includes/header.php'; 
?>

<main>

    <article id="main_article" class="main_article page type-page status-publish has-post-thumbnail hentry">

        <header class="entry-header  header-w-thumbnail">

            <div class="post-thumbnail">
                <img width="1565" height="600" src="assets/img/Bannière_CariBond.webp" class="attachment-post-thumbnail size-post-thumbnail" alt="" decoding="async" srcset="assets/img/Bannière_CariBond.webp 1565w, assets/img/Bannière_CariBond_600.webp 600w, assets/img/Bannière_CariBond_1200.webp 1200w, assets/img/Bannière_CariBond_782.webp 782w"
                sizes="(max-width: 1565px) 100vw, 1565px" /> </div>
        </header>

        <div class="entry-content">

            <?php include 'includes/chat.php'; ?>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-medium-font-size" style="margin-top:var(--preset--spacing--50);margin-bottom:var(--preset--spacing--50)"><strong>Bienvenue à l'agence mon chef !</strong></p>
            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--preset--spacing--50);margin-bottom:var(--preset--spacing--50)">Nous avons une mission des plus importantes pout toi : profiter de la semaine de campagne.</p>

            <div class="block-cover alignfull degrade-t-b" style="margin-top:0;margin-bottom:0;min-height:500px;aspect-ratio:unset;"><span aria-hidden="true" class="block-cover__background has-background-dim"></span><img loading="lazy" decoding="async" width="3992" height="859" class="block-cover__image-background" alt="" src="assets/img/Bannière_test.webp"
                data-object-fit="cover" srcset="assets/img/Bannière_test.webp 3992w" sizes="auto, (max-width: 2400px) 100vw, 2400px" />
                <div class="block-cover__inner-container has-global-padding is-layout-constrained block-cover-is-layout-constrained">

                    <div class="block-group has-global-padding is-content-justification-center is-layout-constrained block-group-is-layout-constrained">
                        <div style="height:50px" aria-hidden="true" class="block-spacer"></div>

                        <div class="block-buttons is-content-justification-center is-layout-flex" style="position: absolute; bottom: -200px; left: 0; right: 0; justify-content: center; gap: 1rem;">
                            <div class="block-button has-custom-font-size is-style-fill has-cooper-hewittheavy-font-family has-normalup-font-size">
                                <a class="block-button__link has-bleu-dark-color has-violet-background-color has-text-color has-background has-link-color element-button" href="https://caribond.fr/programme" style="border-style:solid; border-radius:6px" target="_blank" rel="noreferrer noopener">PROGRAMME</a>
                            </div>
                            <div class="block-button has-custom-font-size is-style-fill has-cooper-hewittheavy-font-family has-normalup-font-size">
                                <a class="block-button__link has-blanc-color has-rouge-background-color has-text-color has-background has-link-color element-button" href="https://caribond.fr/missions" style="border-style:solid; border-radius:6px" target="_blank" rel="noreferrer noopener">MISSIONS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productions -->
            <div style="height:50px" aria-hidden="true" class="block-spacer"></div>
            <h3 class="block-heading has-text-align-center has-blanc-color has-text-color has-link-color">NOS PRODUCTIONS</h3>

            <section class="nos-productions">
                <div class="production-left">
                    <!-- Film -->
                    <iframe src="https://www.youtube.com/embed/WSRbUZvMQTE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; border: none; border-radius:12px;"></iframe>
                </div>
                <div class="production-right">
                    <div class="spotify">
                        <!-- musique -->
                        <iframe style="border-radius:12px; width: 100%; height: 100%;" src="https://open.spotify.com/embed/track/PAS ENCORE HEHE?utm_source=generator&theme=0" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    </div>
                    <div class="production-video">
                        <!-- chorée -->
                        <iframe src="https://www.youtube.com/embed/YDyJPhX3VGw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; border: none; border-radius:12px;"></iframe>
                    </div>
                </div>
            </section>

            <!-- Partenaires -->
            <!-- TODO POUR CYRIL : modif liens + check partenaires -->

            <div style="height:50px" aria-hidden="true" class="block-spacer"></div>

            <h3 class="block-heading has-text-align-center has-blanc-color has-text-color has-link-color">NOS PARTENAIRES</h3>
            
            <div class="partners-carousel">
                <a href="https://www.lyf.eu/fr/" class="partner-logo">
                    <img src="assets/img/partenaires/Lyf.png" alt="Lyf">
                </a>
                <a href="https://clk.tradedoubler.com/click?p=200547&a=3417704&g=25706016" class="partner-logo">
                    <img src="assets/img/partenaires/Monabanq.png" alt="Monabanq">
                </a>
                <a href="https://www.intersport.fr/" class="partner-logo">
                    <img src="assets/img/partenaires/Intersport.png" alt="Intersport">
                </a>
                <!-- <a href="xxx" class="partner-logo">
                    <img src="assets/img/partenaires/JeffDeBruges.png" alt="Jeff De Bruges">
                </a> -->
                <a href="https://fr.igraal.com/parrainage?parrain=AG_67e5948139004" class="partner-logo">
                    <img src="assets/img/partenaires/iGraal.png" alt="iGraal">
                </a>
                <a href="https://africallfood.com/" class="partner-logo">
                    <img src="assets/img/partenaires/AfriCallFood.png" alt="Afri Call Food">
                </a>
                <a href="https://www.facebook.com/p/FripChic-100087309256616" class="partner-logo">
                    <img src="assets/img/partenaires/FripChic.png" alt="FripChic">
                </a>
                <a href="https://nordvpn.com/fr/" class="partner-logo">
                    <img src="assets/img/partenaires/NordVPN.png" alt="NordVPN">
                </a>
                <a href="https://www.lesvinsgourmands.fr/" class="partner-logo">
                    <img src="assets/img/partenaires/LesVinsGourmands.png" alt="Les Vins Gourmands">
                </a>
                <a href="https://www.natureetdecouvertes.com/" class="partner-logo">
                    <img src="assets/img/partenaires/Nature&Decouvertes.png" alt="Nature & Découvertes">
                </a>
                <a href="https://samcash.fr/" class="partner-logo">
                    <img src="assets/img/partenaires/SamCash.png" alt="SamCash">
                </a>
            </div>
            <!-- FIN PARTENAIRES -->
        </div>
        <!-- .entry-content -->

        <div style="height:50px" aria-hidden="true" class="block-spacer hidden-desktop"></div> <!-- spacer mobile -->

    </article>
    <!-- #main_article -->
</main>

<?php include 'includes/footer.php'; ?>
