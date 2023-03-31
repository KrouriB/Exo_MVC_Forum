<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics d'une catégorie</h1>

<?php
foreach($topics as $topic){

    ?>
    <p><a href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getNomTopic()?></a></p>
    <?php
}