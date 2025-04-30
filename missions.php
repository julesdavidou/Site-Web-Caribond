<?php 
    $pageTitle = "Missions - Cari'Bond";
    $link = "missions";
    include 'includes/header.php'; 
?>

<main>
    <article id="main_article" class="main_article page type-page status-publish has-post-thumbnail hentry">
        <header class="entry-header  header-w-thumbnail">
            <div class="post-thumbnail">
                <img width="1565" height="600" src="assets/img/Bannière_CariBond.webp" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" srcset="assets/img/Bannière_CariBond.webp 1565w, assets/img/Bannière_CariBond_600.webp 600w, assets/img/Bannière_CariBond_1200.webp 1200w, assets/img/Bannière_CariBond_782.webp 782w"
                sizes="(max-width: 1565px) 100vw, 1565px" /> </div>
        </header>

        <div class="entry-content">

            <?php include 'includes/chat.php'; ?>

            <h2 class="entry-title wp-block-heading has-text-align-center has-bleu-dark-color has-text-color has-link-color has-busoramabold-font-family"><strong>MISSIONS</strong></h2>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"><strong>
                Cher Agent,</strong></p>
            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)">
                Cette semaine ne sera pas de tout repos : une pléthore de missions t'attend ! (ou de défis, entends-le comme bon te semble...)</p>
            
            <h3 class="wp-block-heading has-text-align-center has-blanc-color has-text-color has-link-color">MISSIONS A&C</h3>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)">
                En tant que membre d'association ou de club, tu es invité à effectuer ta mission, mais également les autres ! Le podium sera récompensé 😎</p>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)">
                Les missions sont également réalisables seul ou en équipe, à condition de s'être inscrit sur le Forms. Lors de la remise des prix, le tirage sera pondéré selon le nombre de missions accomplies. (en gros faut farmer les missions)</p>

            <div class="wp-block-buttons is-content-justification-center is-layout-flex">
                <div class="wp-block-button has-custom-font-size is-style-fill has-cooper-hewittheavy-font-family has-normalup-font-size">
                    <a class="wp-block-button__link has-blanc-color has-rouge-background-color has-text-color has-background has-link-color wp-element-button" href="assets/pdf/Carnet défis A&C.pdf" style="border-style:solid; border-radius:6px" target="_blank" rel="noreferrer noopener">CARNET DE MISSIONS A&C</a>
                </div>
            </div>

        </div>  <!-- .entry-content -->
    </article>
</main>

<?php include 'includes/footer.php'; ?>
