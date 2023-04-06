<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste des topics sans catégorie</h1>

<table>
    <thead>
        <th></th>
    </thead>
    <tbody>
    <?php
    foreach($topics as $topic){
        if($topic->getCategorie() == null){
            $verrou = ($topic->getVerouiller() == 0) ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-lock"></i>' ;
            ?>
            <tr>
                <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getNomTopic()?></a></td>
                <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getUser()->getPseudo()?></a></td>
                <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?=$topic->getDateCreation()?></a></td>
                <td><a class="lienTd" href="index.php?ctrl=forum&action=aTopic&id=<?= $topic->getId() ?>"><?= $verrou ?></a></td>
                <?php
                if(App\Session::isAdmin() OR ($topic->getUser()->getPseudo() == App\Session::getUser())){
                    ?>
                        <td><a href="index.php?ctrl=forum&action=delete&id=<?= $topic->getId() ?>"><i class="fa-regular fa-trash-can"></i></a></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    }
    ?>      
    </tbody>
</table>