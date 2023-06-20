<div id="home-container">
    <div id="entete">
        <h1>BIENVENUE CHEZ LES PTIT'S ELANS</h1>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>
    </div>
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
