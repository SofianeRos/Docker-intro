<?php 
// on demarre la session 

session_start();

if (isset($_SESSION ['email'])) {
    
    header("Location: ./home.php");
    exit();
}


require_once("./templates/_header.php");  ?>

<h1>Inscription</h1>
<?php if (isset($_GET['error'])) { ?>
    <p class="error"> <?php echo $_GET['error'] ?> </p>
<?php } ?>
<form action="./requete/registration.php" method="post">
    <div>
        <label for=""> Saisir votre pseudo : <br> </label>
        <input type="text" name="nickname">
    </div>
    <div>
        <label for=""> saisir votre email : <br> </label>
        <input type="email" name="email">
    </div>
    <div>
        <label for=""> Saisir votre mot de passe : <br> </label>
        <input type="password" name="password">
    </div>

    <button type="submit"> Se connecter </button>

    <p>Vous avez deja un compte <a href="./index.php"> Connectez vous </a></p>


</form>

<?php require_once("./templates/_footer.php"); ?>