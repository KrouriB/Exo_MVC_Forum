<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste categories</h1>

<table>
    <thead>
        <th>Catégorie</th>
    </thead>
    <tbody>      
    <?php
    foreach($categories as $categorie){

        ?>
        <tr>
            <td><a href="index.php?ctrl=forum&action=listTopicsForACategorie&id=<?= $categorie->getId() ?>"><?=$categorie->getNomCategorie()?></a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
