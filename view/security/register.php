<?php
    $titre_page = "Page d'inscription";
    $sousTitre_page = 0;
?>

<div id="container">
    <form action="index.php?ctrl=security&action=newRegister" method="post" id="formPage">
        <div id=blocCompte>
            <div class="uneColForm">
                <div class="uneInfoReg">
                    <label for="email">Email : </label>
                    <div class="blocARemplir">
                        <span><i class="fa-solid fa-at"></i></span>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <div class="uneInfoReg">
                    <label for="password1">Mot de Passe : </label>
                    <div class="blocARemplir">
                        <span><i class="fa-solid fa-key"></i></span>
                        <input type="password" name="password1" id="password1">
                    </div>
                </div>
            </div>
            <div class="uneColForm">
                <div class="uneInfoReg">
                    <label for="pseudo">Pseudo : </label>
                    <div class="blocARemplir">
                        <span><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="pseudo" id="pseudo">
                    </div>
                </div>
                <div class="uneInfoReg">
                    <label for="password2">Veuillez Conffirmez le Mot de Passe : </label>
                    <div class="blocARemplir">
                        <span><i class="fa-solid fa-key"></i></span>
                        <input type="password" name="password2" id="password2">
                    </div>
                </div>
            </div>
        </div>
        <div id="blocButton">
            <input type="reset" value="Videz le Formulaire" class="notCheckInput">
            <input type="submit" value="Inscrivez-Vous" name="submit" class="notCheckInput">
            <div>
                <input type="checkbox" onclick="showPasswordreg()">
                <span><i class="fa-regular fa-eye"></i></span>
            </div>
        </div>
    </form>
</div>