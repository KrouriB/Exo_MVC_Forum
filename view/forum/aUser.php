<?php

$user = $result["data"]['user'];
$topics = $result["data"]['topics'];



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