<?php
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
</div>
