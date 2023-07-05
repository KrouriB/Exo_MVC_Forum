<?php

    $topics = $result["data"]['topics'];
    $categories = $result["data"]['categories'];

    $titre_page = "BIENVENUE CHEZ LES PTIT'S ELANS";
    $sousTitre_page = "<h4>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</h4>"

?>
<div id="container">
    <div id="message-acceuil">
        <?php
            if(App\Session::getUser() == false){
                ?>
                    <p>
                        <a href="index.php?ctrl=security&action=login">Se connecter</a>
                        <span>&nbsp;-&nbsp;</span>
                        <a href="index.php?ctrl=security&action=register">S'inscrire</a>
                    </p>
                <?php
            }
            else{
                ?>
                    <p>Vous êtes connecté !</p>
                <?php
            }
        ?>
    </div>
    <div id="homeLink">
        <h2>Liens :</h2>
        <div>
            <a href="https://github.com/KrouriB" class="homeLigneLink">
                <figure>
                    <img src="<?= PUBLIC_DIR ?>/img/link/github.png" alt="github icon">
                </figure>
                <div class="homeTextLigneLink">
                    <h3>KrouriB</h3>
                    <p>Vous pouvez retrouvez mon github ici</p>
                </div>
            </a>
            <a href="https://preview.themeforest.net/item/flatboots-phpbb-32-highperformance-and-creative-modern-forum-for-phpbb/full_screen_preview/8536771" class="homeLigneLink">
                <figure>
                    <img src="<?= PUBLIC_DIR ?>/img/link/themeforest.png" alt="theme forest icon">
                </figure>
                <div class="homeTextLigneLink">
                    <h3>Theme Forest</h3>
                    <p>Ici le theme dont je me suis inspirer</p>
                </div>
            </a>
            <a href="https://www.linkedin.com/in/brice-krouri-ba3a15252/" class="homeLigneLink">
                <figure>
                    <img src="<?= PUBLIC_DIR ?>/img/link/linkedin.png" alt="linkedin icon">
                </figure>
                <div class="homeTextLigneLink">
                    <h3>Mon Linkedin</h3>
                    <p>Vous pouvez le retrouver ici</p>
                </div>
            </a>
        </div>
    </div>
</div>
