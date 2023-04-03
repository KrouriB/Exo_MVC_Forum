<?php
?>
<form action="index.php?ctrl=security&action=loginTry" method="post" class="formPage">
    <div class="uneInfoLog">
        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div class="uneInfoLog">
        <label for="password">Mot de Passe : </label>
        <div>
            <input type="text" name="password" id="password">
            <button onclick="showPassword()"><i class="fa-regular fa-eye"></i></button>
        </div>
    </div>
    <div>
        <input type="submit" value="Connectez-Vous" name="submit">
    </div>
</form>