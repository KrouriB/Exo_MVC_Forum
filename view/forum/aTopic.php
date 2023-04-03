<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
    
?>

<div id="topTopic">
    <h1><?= $topic->getNomTopic() ?></h1>
    
    <h3><?= $topic->getResumer() ?></h3>
</div>

<?php
if($posts != null){
    foreach($posts as $post){
    
        ?>
        <div class="unMessage">
            <p><?=$post->getMessage()?></p>
            <div>
                <span><?=$post->getUser()->getPseudo() ?></span>
                <span><?=$post->getDatePost() ?></span>
            </div>
        </div>
        <?php
    }   
}
else{
    ?>
    <p>Ce Topic n'as pas de message ! Soyer la 1er personne a lui répondre !</p>
    <?php
}
?>

<form action="index.php?ctrl=forum&action=aPost&id=<?= $_GET['id'] ?>" method="post">
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