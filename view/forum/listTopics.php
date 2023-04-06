<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]['categories'];
    
?>

<h1>liste topics</h1>


<div id="carteContainer">
    <?php
    foreach($topics as $topic){
        $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
        $categorieAfficher = ($topic->getCategorie() != null) ? $topic->getCategorie()->getNomCategorie() : 'sans catégorie';
        ?>
        <div class="carteTopic">
            <a href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                <div class="hautDeCarte">
                    <div class="ligneHaut">
                        <span><?= $verrou ?></span>
                        <p class="nomCategorie" ><?=$categorieAfficher?></p>
                    </div>
                    <p class="nomSujet"><?=$topic->getNomTopic()?></p>  
                </div>
                <div class="basDeCarte">
                    <p class="infoDate"><?=$topic->getUser()->getPseudo()?></p>
                    <p class="infoAuteur"><?=$topic->getDateCreation() ?></p>
                </div>
            </a>
        </div>
        <?php
    }
    ?>
</div>

<form action="index.php?ctrl=forum&action=aNewTopic" method="post">
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
        <label for="categorie">
            Choissisez la catégorie :
        </label>
        <select name="categorie" id="categorie">
            <option value="0">--Veuillez selcetionner une option--</option>
            <?php 
            foreach($categories as $categorie){
                ?>
                <option value="<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div>
        <input type="submit" value="Ajouter votre sujet" name="submitNo">
    </div>
</form>