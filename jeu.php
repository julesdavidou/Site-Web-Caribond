<?php 
    $pageTitle = "Jeu - Caribond";
    $link = "jeu";
    include 'includes/header.php'; 
?>

<head>
  <script src="includes/Jeu/jquery-1.4.1.min.js"></script>
  <script src="includes/Jeu/vector_battle_regular.typeface.js"></script>
  <script src="includes/Jeu/ipad.js"></script>
  <script src="includes/Jeu/game.js"></script>
  <style>
    #canvas { border:1px solid black; top:0px; left:0px; }
    .button { position:absolute; border:1px solid black; }
    #left-controls { position:absolute; left:1px; bottom:0px; display:none; }
    #right-controls { position:absolute; right:1px; bottom:0px; display:none; }
    #up { width:200px; height:100px; bottom:100px;}
    #left { width:100px; height:100px; bottom:0px;}
    #right { width:100px; height:100px; bottom:0px; left:100px; }
    #space { width:200px; height:200px; bottom:0px; right:0px; }
  </style>
</head>

<main>
  <article id="main_article" class="main_article page type-page status-publish has-post-thumbnail hentry">
      <header class="entry-header  header-w-thumbnail">
        <div class="post-thumbnail">
          <img width="1565" height="600" src="assets/img/Bannière_CariBond.webp" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" srcset="assets/img/Bannière_CariBond.webp 1565w, assets/img/Bannière_CariBond_600.webp 600w, assets/img/Bannière_CariBond_1200.webp 1200w, assets/img/Bannière_CariBond_782.webp 782w"
              sizes="(max-width: 1565px) 100vw, 1565px" /> 
        </div>
      </header>
      
      <h2 class="entry-title wp-block-heading has-text-align-center has-bleu-dark-color has-text-color has-link-color has-busoramabold-font-family wp-elements-c1f4c55c64a0b298288e660591e0d694"><strong>LE MAXI JEU</strong></h2>

      <div style="text-align: center;">
        <div id="game-container">
          <canvas id="canvas" width="780" height="540"></canvas>
          <div id="left-controls">
            <div id="up" class='button'>THRUST</div>
            <div id="left" class='button'>LEFT</div>
            <div id="right" class='button'>RIGHT</div>
          </div>
          <div id="right-controls">
            <div id="space" class='button'>FIRE</div>
          </div>
        </div>
      </div>
  </article>
</main>

<?php include 'includes/footer.php'; ?>
