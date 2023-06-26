<?php

    $topics = $result["data"]['topics'];
    $categories = $result["data"]['categories'];
    
    $titre_page = "Liste de tout les Topics";
    $sousTitre_page = 0;
?>

<div id="container">
    <div id="listTopics">
        <?php
        foreach($topics as $topic){
            $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
            $categorieAfficher = ($topic->getCategorie() != null) ? $topic->getCategorie()->getNomCategorie() : 'sans catégorie';
            ?>
            <div class="carteTopic">
                <a href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                    <div id="infoCarte">
                        <h2><?=$topic->getNomTopic()?></h2>
                        <div>
                            <div class="ligneAuteurVerrou">
                                <p class="infoAuteur">By - <?=$topic->getUser()->getPseudo() ?></p>
                                <span><?= $verrou ?></span>
                            </div>
                            <p class="nomCategorie" >Thème : <?=$categorieAfficher?></p>
                        </div>
                        <p class="infoDate"><?=$topic->getDateCreation() ?></p>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<form action="index.php?ctrl=forum&action=aNewTopic" method="post" class="formBasPage">
    <div>
        <label for="topic">
            Le&nbsp;nom&nbsp;de votre&nbsp;Sujet&nbsp;:&nbsp;
        </label>
        <input type="text" name="topic" id="topic">
    </div>
    <div>
        <label for="resume">
            Détail&nbsp;de&nbsp;votre&nbsp;sujet (un&nbsp;"1er&nbsp;message")&nbsp;:&nbsp;
        </label>
        <textarea name="resume" id="resume" cols="4000" rows="10"></textarea>
    </div>
    <div>
        <label for="categorie">
            Choissisez la&nbsp;catégorie&nbsp;:&nbsp;
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
    <div id="submitBas">
        <input type="submit" value="Ajouter votre sujet" name="submitNo">
    </div>
</form>