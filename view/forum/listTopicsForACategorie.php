<?php

    $topics = $result["data"]['topics'];
    $categorie = $result["data"]['categorie'];

    $userInSession = false;
    $firstLine = 0;

    $titre_page = "Liste des topics de la catégorie ".$categorie->getNomCategorie();
    $sousTitre_page = (App\Session::isAdmin()) ? '<div id="trashCat"><a href="index.php?ctrl=forum&action=deleteCategorie&id=<?= $categorie->getId() ?>"><i class="fa-regular fa-trash-can"></i></a></div>' : 0 ;
    
?>

<div id="container">
    <?php
        if($topics != null){
            ?>
            <table id="tableauTopicCategorie">
                <thead>
                    <tr>
                        <th class="first" scope="col">Auteur</th>
                        <th class="second" scope="col">Topic</th>
                        <th class="third" scope="col">Date de Création</th>
                        <th class="fourth" scope="col">Nombre de posts</th>
                        <th class="fifth" scope="col">Date du dernier post</th>
                        <th class="sixth" scope="col">Etat du Topic</th>
                        <?php
                            if(App\Session::isAdmin() OR $userInSession == true){
                                ?>
                                    <th class="seventh" scope="col"></th>
                                <?php
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($topics as $topic){
                    $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
                    ?>
                    <tr>
                        <?php
                            if($firstLine == 0){
                                ?>
                                    <td class="first" data-label="Auteur">
                                        <a class="lienTd" href="index.php?ctrl=forum&action=aUser&id=<?= $topic->getUser()->getId() ?>">
                                            <?=$topic->getUser()->getPseudo()?>        
                                        </a>
                                    </td>
                                <?php
                                $firstLine = 1;
                            }
                            else{
                                ?>
                                    <td class="first" scope="row" data-label="Auteur">
                                        <a class="lienTd" href="index.php?ctrl=forum&action=aUser&id=<?= $topic->getUser()->getId() ?>">
                                            <?=$topic->getUser()->getPseudo()?>        
                                        </a>
                                    </td>
                                <?php
                            }
                        ?>
                        <td class="second" data-label="Topic">
                            <a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>">
                                <?=$topic->getNomTopic()?>
                            </a>
                        </td>
                        <td class="third" data-label="Date de Création">
                            <?=$topic->getDateCreation()?>
                        </td>
                        <td class="fourth" data-label="Nombre de posts">
                            <?=$topic->getNbPost()?>
                        </td>
                        <td class="fifth" data-label="Date du dernier post">
                            <?= ($topic->getLastMsg() != null) ? $topic->getLastMsg() : "-" ?>
                        </td>
                        <td class="sixth" data-label="Etat du Topic">
                            <?= $verrou ?>
                        </td>
                        <?php
                            if(App\Session::isAdmin() OR ($topic->getUser()->getPseudo() == App\Session::getUser())){
                                $userInSession = true;
                                ?>
                                    <td class="seventh" data-label=""><a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"><i class="fa-regular fa-trash-can"></i></a></td>
                                <?php
                            }
                        ?>
                    </tr>
                    <?php
                }
                ?>      
                </tbody>
            </table>
            <div id="navPage">
                <div id="upNav">
                    <div class="mouvNav">
                        <a href="#"><<</a>
                        <a href="#">&nbsp;<&nbsp;</a>
                    </div>
                    <span><!-- $_GET["page"] -->&nbsp;1&nbsp;</span>
                    <div class="mouvNav">
                        <a href="#">&nbsp;>&nbsp;</a>
                        <a href="#">>></a>
                    </div>
                </div>
                <button id="selectPage">Sélectionner une page</button><!-- idée de navigation en saisisant la page vers laquel naviguer avec un prompt en js -->
            </div>
            <?php
        }
        else{
            ?>
                <p>Cette catégorie n'a pas de topics</p>
            <?php
        }
    ?>
</div>

<form action="index.php?ctrl=forum&action=aNewTopic&id=<?= $_GET['id'] ?>" method="post" class="formBasPage">
    <h2>Ajouter un Nouveau Topic :</h2>
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
        <button type="submit" name="submitCate">Ajouter votre sujet</button>
    </div>
</form>