<?php
    include "header.php";
    $nom = "";
    if( isset($_GET["nom"]) ){
        $nom = $_GET['nom'];
    };
    $delegue = false;
    ( $nom == "keylan" || $nom == "charle" ) ? $delegue = true : $delegue = false;

?>

<main>
    <section>
        <h3>Test</h3>

        <?php if(strlen($nom) == 0) { ?> <!-- si nom est vide -->
            <p>Vous n'avez pas de nom</p>
        <?php }  else if($delegue) { ?> <!-- affiche nom -->
            <p>votre nom est <?php echo $nom; ?> et tu es le délégué</p>
        <?php }  else { ?> <!-- affiche nom -->
            <p>votre nom est <?php echo $nom; ?></p>
        <?php } ?>
    </section>
</main>

<?php
    include "footer.php";
?>