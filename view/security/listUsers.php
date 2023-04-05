<?php

$users = $result["data"]['users'];
    
?>

<h1>liste users</h1>

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
            <td><?=$user->getPseudo()?></td>
            <td><?=$user->getEmail()?></td>
            <td><?=$role?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>