<?php

    $topics = $result["data"]['topics'];
    $total = $result["data"]['total'];

    $count = 0;
    foreach($total as $single){
        $count = $single->getTotal();
    }
    $max = (($count % $_SESSION["nbElementsPerPage"]) != 0) ? intdiv($count,$_SESSION["nbElementsPerPage"]) + 1 : intdiv($count,$_SESSION["nbElementsPerPage"]) ;


    $userInSession = false;
    $firstLine = 0;
    
    $titre_page = "Liste des topics sans Catégorie";
    $sousTitre_page = 0;

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
                                        <a class="lienTd" href="index.php?ctrl=forum&action=aUser&id=<?= $topic->getUser()->getId() ?>&page=1">
                                            <?=$topic->getUser()->getPseudo()?>        
                                        </a>
                                    </td>
                                <?php
                                $firstLine = 1;
                            }
                            else{
                                ?>
                                    <td class="first" scope="row" data-label="Auteur">
                                        <a class="lienTd" href="index.php?ctrl=forum&action=aUser&id=<?= $topic->getUser()->getId() ?>&page=1">
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
                    <?php
                    if($_GET["page"] > 1){
                        ?>
                        <div class="mouvNav">
                            <a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie&page=1"><<</a>
                            <a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie&page=<?= $_GET["page"]-1 ?>">&nbsp;<&nbsp;</a>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="mouvNav">
                            <a>&nbsp;&nbsp;&nbsp;</a>
                            <a>&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        <?php    
                    }
                    ?>
                    <span>&nbsp;<?= $_GET["page"] ?>&nbsp;</span>
                    <?php
                    if($_GET["page"] != $max){
                        ?>
                        <div class="mouvNav">
                            <a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie&page=<?= $_GET["page"]+1 ?>">&nbsp;>&nbsp;</a>
                            <a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie&page=<?= $max ?>">>></a>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="mouvNav">
                            <a>&nbsp;&nbsp;&nbsp;</a>
                            <a>&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        <?php    
                    }
                    ?>
                </div>
                <button id="selectPage">Sélectionner une page</button><!-- idée de navigation en saisisant la page vers laquel naviguer avec un prompt en js -->
            </div>
            <?php
        }
        else{
            ?>
                <p>Il n'y a pas de topics sans catégorie</p>
            <?php
        }
    ?>
</div>