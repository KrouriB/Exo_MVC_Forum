<?php
    $topics = $result["data"]['topics'];
    $categories = $result["data"]['categories'];

    
    $titre_page = "Liste de tout les Topics";
    $sousTitre_page = 0;
    
    $format = new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);
?>

<div id="container">
    <div id="listTopics">
        <?php
        foreach($topics as $topic){
            $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
            $categorieAfficher = ($topic->getCategorie() != null) ? $topic->getCategorie()->getNomCategorie() : 'sans catégorie';
            $resume = (strlen($topic->getResumer()) > 25) ? substr($topic->getResumer(),0,25)."[...]" : $topic->getResumer() ;
            // var_dump($topic->getDateCreation());
            $theDate = DateTime::createFromFormat('d/m/Y, H:i:s', $topic->getDateCreation());
            // var_dump($theDate);die;
            // $theDate = new DateTime($topic->getDateCreation());
            ?>
            <div class="carteTopic">
                <a href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                    <div class="infoCarte">
                        <div class="longTitre">
                            <h3><?=$topic->getNomTopic()?></h3>
                        </div>
                        <div>
                            <p class="nomCategorie" >Thème : <?=$categorieAfficher?></p>
                            <div class="ligneAuteurVerrou">
                                <p class="infoAuteur">By - <?=$topic->getUser()->getPseudo() ?></p>
                                <span><?= $verrou ?></span>
                            </div>
                        </div>
                        <p class="infoDate"><?= $theDate->format('d M') ?></p>
                    </div>
                    <p class="resumeTopic"><?= $resume ?></p>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<form action="index.php?ctrl=forum&action=aNewTopic" method="post" class="formBasPage">
    <h2>Ajouter un Nouveau Topic :</h2>
    <div>
        <label for="topic">
            Le&nbsp;nom&nbsp;de votre&nbsp;Sujet&nbsp;:&nbsp;
        </label>
        <input type="text" name="topic" id="topic" placeholder="Sujet:">
    </div>
    <div>
        <label for="resume">
            Détail&nbsp;de&nbsp;votre&nbsp;sujet (un&nbsp;"1er&nbsp;message")&nbsp;:&nbsp;
        </label>
        <textarea name="resume" id="resume" cols="40" rows="10"></textarea>
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
        <button type="submit" name="submitNo">Ajouter votre sujet</button>
    </div>
</form>