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
</div>