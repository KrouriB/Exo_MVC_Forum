<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
    
?>

<h1><?= $topic->getNomTopic() ?></h1>

<h3><?= $topic->getResumer() ?></h3>

<?php
foreach($posts as $post){

    ?>
    <p><?=$post->getMessage()?></p>
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