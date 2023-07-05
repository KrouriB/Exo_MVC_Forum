<?php
    $menu = $result["data"]['categoriesMenu'];
    $nbElemPage = 5 ;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/50e50e8630.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <title>FORUM</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <nav>
                <div id="navLeft">
                    <a href="index.php">
                        <figure>
                            <img src="<?= PUBLIC_DIR ?>/img/elan/img2Elan.png" alt="#" id="imglogo">
                        </figure>
                        Les Ptit's Elans
                    </a>
                </div>
                <div id="navRight">
                    <input type="checkbox" />
                    <span class=barre></span>
                    <span class=barre></span>
                    <span class=barre></span>
                    <ul id=navLink>
                        <?php
                        if (App\Session::getUser()) {
                            ?>
                            <a href="index.php?ctrl=forum&action=aUser&id=<?= App\Session::getUser()->getId() ?>"><li><span class="fas fa-user"></span> <?= App\Session::getUser() ?></li></a>
                            <a href="index.php?ctrl=security&action=logOut"><li>Déconnexion</li></a>
                            <div id="dropdownCat">
                                <li>
                                    <label for="touch">
                                        <span id="titleCat">Catégorie <i class="fa-solid fa-chevron-down"></i></span>
                                    </label>               
                                    <input type="checkbox" id="touch">

                                    <ul class="slide">
                                        <?php
                                            foreach($menu[0] as $option){ if($option->getId() == 0){ continue;}else{?>
                                                <a href="index.php?ctrl=forum&action=listTopicsForACategorie&id=<?= $option->getId() ?>"><li><?= $option->getNomCategorie() ?></li></a>
                                            <?php }}
                                        ?>
                                        <a href="index.php?ctrl=forum&action=listTopicsWithoutCategorie"><li>Sans catégorie</li></a>
                                    </ul>
                                </li>
                            </div>
                            <?php
                            if (App\Session::isAdmin()) {
                            ?>
                                <a href="index.php?ctrl=security&action=listUsers"><li>Voir la liste des gens</li></a>
                            <?php
                            }
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics"><li>la liste des topics</li></a>
                        <?php
                        } else {
                        ?>
                            <a href="index.php?ctrl=security&action=login"><li>Connexion</li></a>
                            <a href="index.php?ctrl=security&action=register"><li>Inscription</li></a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>
        <div id="mainPage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <?= App\Session::getFlash("error") ?>
            <?= App\Session::getFlash("success") ?>
            <main>
                <div id="topMain">
                    <h1><?= $titre_page ?></h1>
                    <?php
                        if($sousTitre_page != 0){
                            echo $sousTitre_page;
                        }
                    ?>
                    
                </div>
                <?= $page ?>
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
            </main>
        </div>
        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(".message").each(function() {
                if ($(this).text().length > 0) {
                    $(this).slideDown(500, function() {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })



        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>

</html>
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <nav>
            <div id="navLeft">

            </div>
            <div id="navRight">

            </div>
        </nav>
    </header>
    <div id="wrapper">
        <main>
            <?= $content ?>
        </main>
    </div>
    <footer>
        
    </footer>
</body>
</html>-->



<!-- 
<i class="fa-solid fa-lock"></i> verouiller
<i class="fa-regular fa-lock-open"></i> déverouiller
-->