<?php

    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic'];

    $titre_page = $topic->getNomTopic();
    $sousTitre_page = "<div id='infoTopic'><h4><a href='index.php?ctrl=forum&action=aUser&id=".$topic->getUser()->getId()."'>".$topic->getUser()->getPseudo()."</a><h4>".$topic->getDateCreation()."</h4></div>";

?>

<div id="topTopic">
    <div id="botTopic">
        <h3><?= $topic->getResumer() ?></h3>
        <?php
        if (($topic->getUser()->getPseudo() == App\Session::getUser()) OR App\Session::isAdmin()){
            ?>
            <div id="adminTopic">
            <?php
            if($topic->getVerouiller() == 0){
                ?>
                    <a href="index.php?ctrl=forum&action=verouillerTopic&id=<?= $_GET['id'] ?>">Verouiller le Topic</a>
                    <?php
            }
            ?>
                <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"><i class="fa-regular fa-trash-can"></i></a>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<div id="lesMessages">
    <?php
        if ($posts != null) {
            foreach ($posts as $post) {
    ?>
        <div class="unMessage">
            <p><?= $post->getMessage() ?></p>
            <div class="infoMsg">
                <div id="infoMsgGauche">
                    <span><?= $post->getUser()->getPseudo() ?></span>
                    <span><?= $post->getDatePost() ?></span>
                </div>
                <?php
                    if(App\Session::isAdmin() OR ($post->getUser()->getPseudo() == App\Session::getUser())){
                ?>
                <a href="index.php?ctrl=forum&action=deleteMessage&id=<?= $post->getId() ?>"><i class="fa-regular fa-trash-can"></i></a>
        <?php
            }
        ?>
            </div>
        </div>
    <?php
        }
}
elseif($topic->getVerouiller() == 1) {
    ?>
        <p>Ce Topic est vide et verouiller.</p>
    <?php
}
else{
    ?>
        <p>Ce Topic n'as pas de message ! Soyer la 1er personne a lui répondre !</p>
    <?php
}
    ?>
</div>

<?php
    if($topic->getVerouiller() == 0){
        ?>
            <form action="index.php?ctrl=forum&action=addPost&id=<?= $_GET['id'] ?>" method="post" class="formBasPage">
                <h2>Envoyer votre Réponse</h2>
                <div>
                    <label for="messageForm">
                        Votre&nbsp;message&nbsp;:
                    </label>
                    <textarea name="messageForm" id="messageForm" cols="4000" rows="10"></textarea>
                </div>
                <div id="submitBas">
                    <button type="submit" name="submit">Envoyer votre message</button>
                </div>
            </form>
        <?php
    }
?>

