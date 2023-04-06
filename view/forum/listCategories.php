<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste categories</h1>

<table>
    <thead>
        <th>Catégorie</th>
    </thead>
    <tbody>      
    <?php
    foreach($categories as $categorie){

        ?>
        <tr>
            <td><a href="index.php?ctrl=forum&action=listTopicsForACategorie&id=<?= $categorie->getId() ?>"><?=$categorie->getNomCategorie()?></a></td>
            <?php
            if(App\Session::isAdmin()){
                ?>
                    <td><a href="index.php?ctrl=forum&action=deleteCategorie&id=<?= $categorie->getId() ?>"><i class="fa-regular fa-trash-can"></i></a></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td><a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie">Sans catégorie</a></td>
    </tr>
    </tbody>
</table>

<?php
if(App\Session::isAdmin()){
    ?>
    <form action="index.php?ctrl=forum&action=addCategorie" method="post" class="formBasPage">
        <div>
            <label for="nomCategorie">Inserer&nbsp;le&nbsp;nom&nbsp;de votre&nbsp;categorie&nbsp;:&nbsp;</label>
            <input type="text" name="nomCategorie" id="nomCategorie">
        </div>
        <div id="submitBas">
            <input type="submit" value="Rajouter la catégorie" name="submit">
        </div>
    </form>
    <?php
}
?>