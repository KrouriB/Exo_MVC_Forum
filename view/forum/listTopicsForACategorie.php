<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];
    
?>

<h1>liste des topics de la catégorie <?= $categorie->getNomCategorie() ?></h1>

<table>
    <thead>
        <th></th>
    </thead>
    <tbody>
    <?php
    foreach($topics as $topic){
        $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
        ?>
        <tr>
            <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getNomTopic()?></a></td>
            <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getUser()->getPseudo()?></a></td>
            <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getDateCreation()?></a></td>
            <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?= $verrou ?></a></td>
        </tr>
        <?php
    }
    ?>      
    </tbody>
</table>


<form action="index.php?ctrl=forum&action=aNewTopic&id=<?= $_GET['id'] ?>" method="post">
    <div>
        <label for="topic">
            Le nom de votre Sujet:
        </label>
        <input type="text" name="topic" id="topic">
    </div>
    <div>
        <label for="resume">
            Détail de votre sujet (un "1er message"):
        </label>
        <textarea name="resume" id="resume" cols="30" rows="10"></textarea>
    </div>
    <div>
        <input type="submit" value="Ajouter votre sujet" name="submitCate">
    </div>
</form>