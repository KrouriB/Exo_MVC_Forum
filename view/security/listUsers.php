<?php

$users = $result["data"]['users'];
    
?>

<h1>liste users</h1>

<?php
foreach($users as $user){

    ?>
    <p><?=$user->getPseudo()?></p>
    <?php
}