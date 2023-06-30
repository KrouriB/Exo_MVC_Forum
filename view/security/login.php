<?php
    $titre_page = "Page de connexion";
    $sousTitre_page = 0;
?>

<div id="container">
    <div>
        <div class="blocCol">
            <div class="titleCol">
                <span>Inscrivez vous</span>
            </div>
            <p>
                Pour pouvoir vous connecter, vous devez être enregistré. L'enregistrement ne prend que quelques instants mais vous donne des possibilités accrues. L'administrateur du forum peut également accorder des autorisations supplémentaires aux utilisateurs enregistrés. Avant de vous inscrire, assurez-vous d'avoir pris connaissance de nos conditions d'utilisation et de nos politiques connexes. Veillez à lire les règles du forum lorsque vous naviguez sur le forum.
            </p>
            <div id="blocLinkCol">
                <a href="#">Terme d'utilisation</a>
                <a href="#">Politique de confidentialité</a>
            </div>
            <a href="index.php?ctrl=security&action=register" class="notCheckInput">Enregistrez Vous</a>
        </div>
        <div class="blocCol">
            <div class="titleCol">
                <span>Connectez vous</span>
            </div>
            <form action="index.php?ctrl=security&action=loginTry" method="post" id="formPage">
                <div id="blocInfoCo">
                    <div class="uneInfoLog">
                        <div class="blocARemplir">
                            <span><i class="fa-sharp fa-solid fa-at"></i></span>
                            <input type="email" name="email" id="email" placeholder="Email :">
                        </div>
                    </div>
                    <div class="uneInfoLog">
                        <div class="blocARemplir">
                            <span><i class="fa-solid fa-unlock"></i></span>
                            <input type="password" name="password" id="password" placeholder="Mot de Passe :">
                        </div>
                    </div>
                </div>
                <div id="blocButtonCo">
                    <input type="submit" value="Connectez-Vous" name="submit" class="notCheckInput">
                    <div>
                        <input type="checkbox" onclick="showPasswordlog()">
                        <span><i class="fa-regular fa-eye"></i></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>