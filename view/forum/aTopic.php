<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>

<div id="topTopic">
    <div id="sousInfoTopic">
        <h1><?= $topic->getNomTopic() ?></h1>
        <div id="infoTopicDroite">
            <h4><?= $topic->getUser()->getPseudo() ?></h4>
            <h4><?= $topic->getDateCreation() ?></h4>
        </div>
    </div>
    <div id="botTopic">
        <h3><?= $topic->getResumer() ?></h3>
        <?php
        if ($topic->getUser()->getPseudo() == App\Session::getUser()){
            ?>
            <a href="index.php?ctrl=forum&action=verouillerTopic&id=<?= $_GET['id'] ?>">Verouiller le Topic</a>
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
                    <span><?= $post->getUser()->getPseudo() ?></span>
                    <span><?= $post->getDatePost() ?></span>
                </div>
            </div>
        <?php
    }
} else {
        ?>
        <p>Ce Topic n'as pas de message ! Soyer la 1er personne a lui répondre !</p>
    <?php
}
    ?>
</div>

<form action="index.php?ctrl=forum&action=aPost&id=<?= $_GET['id'] ?>" method="post" class="formBasPage">
    <div>
        <label for="messageForm">
            Votre message
        </label>
        <textarea name="messageForm" id="messageForm" cols="30" rows="10"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer votre message" name="submit">
    </div>
</form>