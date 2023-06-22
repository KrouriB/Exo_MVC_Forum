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
                <div id="nav-left">
                    <a href="index.php">
                        <img src="<?= PUBLIC_DIR ?>/img/elan2/img2Elan.png" alt="#" id="imglogo">
                        Les Ptit's Elans
                    </a>
                </div>
                <div id="nav-right">
                    <?php
                    if (App\Session::getUser()) {
                        ?>
                        <a href="index.php?ctrl=forum&action=aUser&id=<?= App\Session::getUser()->getId() ?>"><span class="fas fa-user"></span>&nbsp;&nbsp;<?= App\Session::getUser() ?></a>
                        <a href="index.php?ctrl=security&action=logOut">Déconnexion</a>
                        <?php
                        if (App\Session::isAdmin()) {
                        ?>
                            <a href="index.php?ctrl=security&action=listUsers">Voir la liste des gens</a>
                        <?php
                        }
                        ?>
                        <a href="index.php?ctrl=forum&action=listTopics">la liste des topics</a>
                        <a href="index.php?ctrl=forum&action=listCategories">la liste des categories</a>
                    <?php
                    } else {
                    ?>
                        <a href="index.php?ctrl=security&action=login">Connexion</a>
                        <a href="index.php?ctrl=security&action=register">Inscription</a>
                    <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <?= App\Session::getFlash("error") ?>
            <?= App\Session::getFlash("success") ?>

            <main id="forum">
                <?= $page ?>
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