<?php

session_start();
// on detruit la session 
session_destroy();

// on redirige vers la page de connexion
header("Location: ../index.php?error = Vous etes deconnecte");
exit();
?>