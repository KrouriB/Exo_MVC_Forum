<?php

    $user = $result["data"]['user'];
    $topics = $result["data"]['topics'];
    $total = $result["data"]['total'];

    $count = 0;
    foreach($total as $single){
        $count = $single->getTotal();
    }
    $max = (($count % $_SESSION["nbElementsPerPage"]) != 0) ? intdiv($count,$_SESSION["nbElementsPerPage"]) + 1 : intdiv($count,$_SESSION["nbElementsPerPage"]) ;



    if($_GET["id"] == App\Session::getUser()->getId()){
        $titre_page = "Bienvenu su votre page Utilisateur";
    }
    else{
            $titre_page = "Voici la page de ".$user->getPseudo();
    }
    if($topics != null){
        $sousTitre_page = 0;
?>
<div id="container">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Categorie</th>
                <th>Date de création</th>
                <th>Nombre de post</th>
                <th>Etat</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($topics as $topic){
                    $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
                    $categorieAfficher = ($topic->getCategorie() != null) ? $topic->getCategorie()->getNomCategorie() : 'sans catégorie';
                    $delete = (($_GET["id"] == App\Session::getUser()->getId()) OR App\Session::isAdmin()) ? '<a href="index.php?ctrl=forum&action=deleteTopic&id='.$topic->getId().'"><i class="fa-regular fa-trash-can"></i></a>' : "" ;
            ?>
                <tr>
                    <td><a href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?= $topic->getNomTopic() ?></a></td>
                    <td><?= $categorieAfficher ?></td>
                    <td><?= $topic->getDateCreation() ?></td>
                    <td><?= $topic->getNbPost() ?></td>
                    <td><?= $verrou ?></td>
                    <td><?= $delete ?></td>
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
                    <a href="index.php?ctrl=forum&action=aUser&id=<?= App\Session::getUser()->getId() ?>&page=1"><<</a>
                    <a href="index.php?ctrl=forum&action=aUser&id=<?= App\Session::getUser()->getId() ?>&page=<?= $_GET["page"]-1 ?>">&nbsp;<&nbsp;</a>
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
                    <a href="index.php?ctrl=forum&action=aUser&id=<?= App\Session::getUser()->getId() ?>&page=<?= $_GET["page"]+1 ?>">&nbsp;>&nbsp;</a>
                    <a href="index.php?ctrl=forum&action=aUser&id=<?= App\Session::getUser()->getId() ?>&page=<?= $max ?>">>></a>
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
</div>
<?php
}
else{
    if($_GET["id"] == App\Session::getUser()->getId()){
        $sousTitre_page = "<h4>Vous n'avez pas ouvert de Topic</h4>";
    }
    else{
        $sousTitre_page = "<h4>Cette utilisateur n'as pas ouvert de topic</h4>";
    }
}