<?php 

// on demarre la session 

session_start();

// on verifie si l'utilisateur est connecte

if (!isset($_SESSION ['email'])) {
    
    header("Location: ./home.php");
    exit();
}

var_dump($_SESSION ['email']);


require_once("./templates/_header.php");  ?> 

<h1>Acceuil</h1>
<a href="./requete/logout.php"> Deconnexion <br> </a>
<a href="./product.php"> Ajouter un produit <br> </a> 

<?php require_once("./templates/_footer.php"); ?> 