<?php

    $users = $result["data"]['users'];


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
                            <td><a href="index.php?ctrl=forum&action=aUser&id=<?= $user->getId() ?>"><?=$user->getPseudo()?></a></td>
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
</div>


