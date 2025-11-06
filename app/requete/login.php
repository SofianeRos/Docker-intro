<?php

session_start();


require_once("../config/database.php");
require_once("../tools/functions.php");

global $connexion;
// on verifie qu'on recoit bien les datas du formulaire

if (isset($_POST['email']) && isset($_POST['password'])) {
    // on declare et securise les variables

    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);




    // verification des champs vides et de la validite des donnees
    if (empty($email)) {
        header("Location: ../index.php?error=Veuillez renseigner un email");
        exit();
    } else if (empty($password)) {
        header("Location: ../index.php?error=Veuillez renseigner un mot de passe ");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=Veuillez renseigner un email valide");
        exit();
    } else {
        // si on arrive ici c'est que tout va bien
        //on verifie si l'email n'existe pas deja en base de donnees
        // dans une variable on va ecrire la requete sql
        $query = "SELECT * FROM `user` WHERE `email` = ? ";

        // on va preparer la requete
        if ($stmt = mysqli_prepare($connexion, $query)) {
            // si la requete s'est bien preparee on peut bind les parametres
            mysqli_stmt_bind_param(
                $stmt, // on passe en 1er parametre la preparation
                "s", // on precise le type de chaque ? (s = string, i = integer, d = decimal)
                $email // on donne la valeur de chaque ? dans l'ordre
            );
            // on execute la preparation
            $execute = mysqli_stmt_execute($stmt);
            // on verifie que l'excution s'est bien passee
            if ($execute) {
                // si elle s'est bien executee on recupere le resultat
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) < 1) {
                    mysqli_close($connexion);
                    header("Location: ../index.php?error= Email et/ou mot de passe incorrect");
                    exit();
                }


                // si on a des resultats on va les parcourir et verifier le mot de passe et e-mail 

                while ($user = mysqli_fetch_assoc($result)) {
                    if ($user['email'] === $email && password_verify($password, $user['password'])) {
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['nickname'] = $user['nickname'];
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['is_active'] = $user['is_active'];
                        header("location: ../home.php");
                        exit();
                    } else {
                        mysqli_close($connexion);
                        header("Location: ../index.php?error= Email et/ou mot de passe incorrect");
                        exit();
                    }
                } 
                
            
             
            
            
            
            
            
            } else {
                header("Location: ../index.php?error=Erreur lors de l'execution de la requete");
                exit();
            }
        } else {
            header("Location: ../index.php?error=Erreur lors de la preparation de la requete");
            exit();
        }
    }
} else {

    var_dump("erreur de formulaire");
}
