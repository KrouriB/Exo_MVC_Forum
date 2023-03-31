<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
    
?>

<div id="topTopic">
    <h1><?= $topic->getNomTopic() ?></h1>
    
    <h3><?= $topic->getResumer() ?></h3>
</div>

<?php
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
?>

<form action="#" methode="post">
    <div>
        <label for="">
            Votre message
        </label>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer votre message">
    </div>
</form>