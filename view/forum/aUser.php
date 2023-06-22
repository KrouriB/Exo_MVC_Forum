<?php

$user = $result["data"]['user'];
$topics = $result["data"]['topics'];

// var_dump($topics[0]->getNbTopic());die;

// $nbTopic = ($topics[0]->getNbTopic() != null) ? $topics[0]->getNbTopic() : 0;

if($_GET["id"] == App\Session::getUser()->getId()){
    ?>
        <h1 id="titre-user">Bienvenu su votre page Utilisateur</h1>
    <?php
}
else{
    ?>
        <h1 id="titre-user">Voici la page de <?= $user->getPseudo() ?></h1>
    <?php
}
if($topics != null){
    ?>
    <div id="user-table">
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
                        <td><?= $topic->getNomTopic() ?></td>
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
    </div>
    <?php
}
else{
    if($_GET["id"] == App\Session::getUser()->getId()){
        ?>
            <p id="infoTopicUser">Vous n'avez pas ouvert de Topic</p>
        <?php
    }
    else{
        ?>
            <p  id="infoTopicUser">Cette utilisateur n'as pas ouvert de topic</p>
        <?php
    }
}