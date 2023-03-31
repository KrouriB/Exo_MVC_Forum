<?php

$posts = $result["data"]['posts'];
    
?>

<h1>liste posts</h1>

<?php
foreach($posts as $post){

    ?>
    <p><?=$post->getMessage()?></p>
    <?php
}
?>

<form action="#" methode="post">
    <div>
        <label for="">
            Votre message
        </label>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer votre message">
    </div>
</form>