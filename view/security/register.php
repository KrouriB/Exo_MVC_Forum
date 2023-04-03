<?php
?>
<form action="index.php?ctrl=security&action=newRegister" method="post" class="formPage">
    <div class="uneInfoLog">
        <label for="email">Email : </label>
        <input type="email" name="email" id="email">
    </div>
    <div class="uneInfoLog">
        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div class="uneInfoLog">
        <label for="password1">Mot de Passe : </label>
        <div>
            <input type="password" name="password1" id="password1">
            <button onclick="showPassword()"><i class="fa-regular fa-eye"></i></button>
        </div>
    </div>
    <div class="uneInfoLog">
        <label for="password2">Veuillez Conffirmez le Mot de Passe : </label>
        <input type="password" name="password2" id="password2">
    </div>
    <div>
        <input type="submit" value="Inscrivez-Vous" name="submit">
    </div>
</form>