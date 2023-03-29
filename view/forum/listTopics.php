<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic){

    ?>
    <p><a href="#"><?=$topic->getNomTopic()?></a></p>
    <?php
}