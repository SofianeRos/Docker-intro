<?php 
// on demarre la session 

session_start();

if (!isset($_SESSION ['email'])) {
    
    header("Location: ./home.php");
    exit();
}

require_once("./templates/_header.php");  ?> 

<h1>Mes Produits</h1>
<a href="./home.php"> Revenir a l'acceuil </a>

<form action="./requete/add-product.php" method="POST" enctype="multipart/form-data">
<div>
    <label> Ajouter Titre : <br> </label>
    <input type="text" name="title">
</div>
<div>
    <label> Ajouter Description : <br> </label>
    <textarea name="description" cols="25" rows="8"></textarea>
</div>
<div>
    <label> Ajouter prix : <br></label>
    <input type="number" name="price">
</div>
<div>
    <label> Ajouter une image : <br></label>
    <input type="file" name="image">
</div>
<button type="submit"> Ajouter le produit <br></button>

</form>

<?php require_once("./templates/_footer.php"); ?> 