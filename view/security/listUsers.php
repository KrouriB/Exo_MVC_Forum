<?php

    $users = $result["data"]['users'];
    $total = $result["data"]['total'];

    $count = 0;
    foreach($total as $single){
        $count = $single->getTotal();
    }
    $max = (($count % $_SESSION["nbElementsPerPage"]) != 0) ? intdiv($count,$_SESSION["nbElementsPerPage"]) + 1 : intdiv($count,$_SESSION["nbElementsPerPage"]) ;


    $titre_page = "Liste des Utilisateurs";
    $sousTitre_page = 0

    
?>

<div id="container">
    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>    
            <?php
                foreach($users as $user){
                    $roleFull = explode('_',$user->getRole());
                    $role = strtolower(end($roleFull));
                    ?>
                        <tr>
                            <td><a href="index.php?ctrl=forum&action=aUser&id=<?= $user->getId() ?>&page=1"><?=$user->getPseudo()?></a></td>
                            <td><?=$user->getEmail()?></td>
                            <td><?=$role?></td>
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
                    <a href="index.php?ctrl=security&action=listUsers&page=1"><<</a>
                    <a href="index.php?ctrl=security&action=listUsers&page=<?= $_GET["page"]-1 ?>">&nbsp;<&nbsp;</a>
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
                    <a href="index.php?ctrl=security&action=listUsers&page=<?= $_GET["page"]+1 ?>">&nbsp;>&nbsp;</a>
                    <a href="index.php?ctrl=security&action=listUsers&page=<?= $max ?>">>></a>
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


