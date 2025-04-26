<?php
$page_title = "Divisions - Cari’Bond";
$body_class = "page-divisions";
?>

<div id="particles-js"></div>

<div class="performar_area">
    <div class="container">
        <div class="row justify-content-center">
            <?php 
            $divisions = [
                ["name" => "Bureau", "img" => "assets/images/team-alpha.jpg", "desc" => "L'équipe qui gère toute l'organisation.", "link" => "bureau.php"],
                ["name" => "BDS", "img" => "assets/images/team-beta.jpg", "desc" => "Gestion du sport et des événements sportifs.", "link" => "bds.php"],
                ["name" => "BDA", "img" => "assets/images/team-alpha.jpg", "desc" => "Culture, arts et spectacles.", "link" => "bda.php"],
                ["name" => "Comm", "img" => "assets/images/team-beta.jpg", "desc" => "Communication et marketing de la liste.", "link" => "comm.php"],
                ["name" => "Opé", "img" => "assets/images/team-alpha.jpg", "desc" => "Organisation des événements et soirées.", "link" => "ope.php"],
                ["name" => "Partenariats", "img" => "assets/images/team-beta.jpg", "desc" => "Gestion des sponsors et partenaires.", "link" => "partenariats.php"],
            ];

            foreach ($divisions as $division) {
                echo '
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single_performer wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <div data-tilt class="thumb shadow-lg">
                            <a href="'.$division["link"].'">
                                <img src="'.$division["img"].'" alt="Photo '.$division["name"].'">
                            </a>
                        </div>
                        <div class="performer_heading">
                            <div id="title-'.$division["name"].'" class="division-title"></div>
                            <span>'.$division["desc"].'</span>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<script src="assets/js/text-animation.js"></script>

<script src="assets/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/tilt.jquery.js"></script>
<script>
    $(document).ready(function() {
        $('.thumb').tilt({
            axis: x,
            scale: 1.1,
            glare: true,
            maxGlare: .3
        });
    });
</script>