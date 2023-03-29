<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste categories</h1>

<?php
foreach($categories as $categorie ){

    ?>
    <p><?=$categorie->getNomCategorie()?></p>
    <?php
}