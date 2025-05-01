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

            <div style="height:50px" aria-hidden="true" class="block-spacer hidden-desktop"></div> <!-- spacer mobile -->

            <h2 class="entry-title block-heading has-text-align-center has-bleu-dark-color has-text-color has-link-color has-busoramabold-font-family"><strong>MISSIONS</strong></h2>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"><strong>
                Cher Agent,</strong></p>
            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)">
                Cette semaine ne sera pas de tout repos : une pléthore de missions t'attend ! (ou de défis, entends-le comme bon te semble...)</p>
            
            <h3 class="block-heading has-text-align-center has-blanc-color has-text-color has-link-color">MISSIONS A&C</h3>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)">
                Nos meilleurs responsables d'A&C ont pour mission de réaliser leur défi, sans passeport, pour une petite récompense.
            </p>

            <p class="has-text-align-center has-blanc-color has-text-color has-link-color has-normalup-font-size" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)">
                Quant à vous, agents, nous vous souhaitons bon courage pour tous les réaliser.
                <br>Formez vos équipes : plus vous êtes nombreux, plus vous avez de chances de mettre la main sur le butin, mais moins vous êtes, moins vous aurez à vous le partager.
                <br>À vous de monter le coup parfait !
            </p>

            <div class="block-buttons is-content-justification-center is-layout-flex">
                <div class="block-button has-custom-font-size is-style-fill has-cooper-hewittheavy-font-family has-normalup-font-size">
                    <a class="block-button__link has-blanc-color has-rouge-background-color has-text-color has-background has-link-color wp-element-button" href="assets/pdf/Carnet défis A&C.pdf" style="border-style:solid; border-radius:6px" target="_blank" rel="noreferrer noopener">CARNET DE MISSIONS A&C</a>
                </div>
            </div>

            <?php
            $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTQibCxBsDaviPDbL-b8yqpAcfFDmgyf0sNVB4aTMpL9BLcnDbbmomQGPcbqWhN40FwPntpjaAJXb8J/pub?output=csv&gid=870713603';
            if ($data = @file_get_contents($csvUrl)) {
                $lines = array_filter(array_map('trim', explode("\n", $data)));
                echo '<table class="ranking-table">';
                // le big header
                $headers = str_getcsv(array_shift($lines));
                echo '<thead><tr>';
                foreach ($headers as $h) {
                    echo '<th>'.htmlspecialchars($h).'</th>';
                }
                echo '</tr></thead><tbody>';
                // classement
                foreach ($lines as $line) {
                    $cols = str_getcsv($line);
                    echo '<tr><td>'.htmlspecialchars($cols[0]).'</td><td>'.htmlspecialchars($cols[1]).'</td></tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p style="color:#FAF9F6; text-align:center;">Classement non disponible.</p>';
            }
            ?>

        </div>  <!-- .entry-content -->
  
        <div style="height:50px" aria-hidden="true" class="block-spacer hidden-desktop"></div> <!-- spacer mobile -->

    </article>
</main>

<?php include 'includes/footer.php'; ?>
