<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];
    
?>

<h1>liste des topics de la catégorie <?= $categorie->getNomCategorie() ?></h1>

<?php
if($topics != null){
    ?>
    <table id="tableauTopicCategorie">
        <thead>
            <tr>
                <th class="first">Auteur</th>
                <th class="second">Topic</th>
                <th class="third">Date de Création</th>
                <th class="fourth">Nombre de posts</th>
                <th class="fifth">Date du dernier post</th>
                <th class="sixth">Etat du Topic</th>
                <th class="seventh"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($topics as $topic){
            $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
            ?>
            <tr>
                <td class="first">
                    <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                        <?=$topic->getUser()->getPseudo()?>        
                    </a>
                </td>
                <td class="second">
                    <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                        <?=$topic->getNomTopic()?>
                    </a>
                </td>
                <td class="third">
                    <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                        <?=$topic->getDateCreation()?>
                    </a>
                </td>
                <td class="fourth">
                    <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                        <?=$topic->getNbPost()?>
                    </a>
                </td>
                <td class="fifth">
                    <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                        <?=$topic->getLastMsg()?>
                    </a>
                </td>
                <td class="sixth">
                    <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                        <?= $verrou ?>
                    </a>
                </td>
                <?php
                    if(App\Session::isAdmin() OR ($topic->getUser()->getPseudo() == App\Session::getUser())){
                        ?>
                            <td class="seventh"><a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"><i class="fa-regular fa-trash-can"></i></a></td>
                        <?php
                    }
                    else{
                        ?>
                            <td class="seventh"></td>
                        <?php
                    }
                ?>
            </tr>
            <?php
        }
        ?>      
        </tbody>
    </table>
    <?php
}
else{
    ?>
    <p>Cette catégorie n'a pas de topics</p>
    <?php
}
?>

<form action="index.php?ctrl=forum&action=aNewTopic&id=<?= $_GET['id'] ?>" method="post" class="formBasPage">
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
    <div id="submitBas">
        <input type="submit" value="Ajouter votre sujet" name="submitCate">
    </div>
</form>

