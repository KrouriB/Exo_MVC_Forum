<div id="login-container">
    <form action="index.php?ctrl=security&action=loginTry" method="post" class="formPage">
        <div class="uneInfoLog">
            <label for="email">Email : </label>
            <input type="email" name="email" id="email">
        </div>
        <div class="uneInfoLog">
            <label for="password">Mot de Passe : </label>
            <div>
                <input type="password" name="password" id="password" class="mdp">
                <input type="checkbox" onclick="showPasswordlog()"><i class="fa-regular fa-eye"></i>
            </div>
        </div>
        <div>
            <input type="submit" value="Connectez-Vous" name="submit">
        </div>
    </form>
</div>