<?php

$user = $result["data"]['user'];
$topics = $result["data"]['topics'];

if($_GET["id"] == App\Session::getUser()->getId()){

}
else{

}

?>

<div>
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