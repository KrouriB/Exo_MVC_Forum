<?php

    $categories = $result["data"]['categories'];
    
    $titre_page = "Liste des Categories";
    $sousTitre_page = 0;
?>

<div id="container">
    <?php
        foreach($categories as $categorie){
            ?>
                <div class="cateNom">
                    <a href="index.php?ctrl=forum&action=listTopicsForACategorie&id=<?= $categorie->getId() ?>"><?=$categorie->getNomCategorie()?></a></td>
                        <?php
                            if(App\Session::isAdmin()){
                                ?>
                                    <a href="index.php?ctrl=forum&action=deleteCategorie&id=<?= $categorie->getId() ?>"><i class="fa-regular fa-trash-can"></i></a>
                                <?php
                            }
                        ?>
                </div>
            <?php
        }
    ?> 
    <div class="cateNom">
        <a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie">Sans catégorie</a>
    </div>
</div>

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