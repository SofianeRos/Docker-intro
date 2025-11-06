<?php

// on demarre la session 

session_start();



require_once("./templates/_header.php");

?>

<h1>Connexion</h1>
<?php if (isset($_GET['error'])) { ?>
    <p class="error"> <?php echo $_GET['error'] ?> </p>
<?php } ?>

<form action="./requete/login.php" method="post">
    <div>
        <label for=""> Saisir votre email : <br></label>
        <input type="email" name="email">
    </div>
    <div>
        <label for=""> Saisir votre mot de passe : <br></label>
        <input type="password" name="password">
    </div>

    <button type="submit"> Se connecter </button>

    <p>Vous n'avez pas de compte <a href="./register.php"> inscrivez vous </a></p>


</form>

<?php require_once("./templates/_footer.php"); ?>