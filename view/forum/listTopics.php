<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic){

    ?>
    <p><a href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getNomTopic()?></a></p>
    <?php
}
?>

<form action="#" methode="post">
    <div>
        <label for="">
            Le nom de votre Sujet:
        </label>
        <input type="text" name="" id="">
    </div>
    <div>
        <label for="">
            Détail de votre sujet (un "1er message"):
        </label>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <label for="">
            Choissisez la catégorie :
        </label>
        <select name="" id="">
            <option value="0">--Veuillez selcetionner une option--</option>
            <?php /*
            foreach(){
                */?>
                    <!--<option value="#">#</option>-->
                    <?php/*
            }
            */ ?>
        </select>
    </div>
    <div>
        <input type="submit" value="Ajouter votre sujet">
    </div>
</form>