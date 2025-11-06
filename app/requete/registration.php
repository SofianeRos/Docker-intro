<?php

session_start();


require_once("../config/database.php");
require_once("../tools/functions.php");

global $connexion;
// on verifie qu'on recoit bien les datas du formulaire

if (isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password'])) {
    // on declare et securise les variables
    $nickname = validate($_POST['nickname']);
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);
    $is_active = true;

    // on va hasher le mot de passe
    $pass_hash = password_hash($password, PASSWORD_BCRYPT);


    // verification des champs vides et de la validite des donnees
    if (empty($nickname)) {
        header("Location: ../register.php?error=Veuillez renseigner un pseudo");
        exit();
    } else if (empty($email)) {
        header("Location: ../register.php?error=Veuillez renseigner un email");
        exit();
    } else if (empty($password)) {
        header("Location: ../register.php?error=Veuillez renseigner un mot de passe ");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Veuillez renseigner un email valide");
        exit();
    } else if (!check_password($password)) {
        header("Location: ../register.php?error=Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre");
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

                if (mysqli_num_rows($result) > 0) {
                    // si on entre dans cette condition c'est que l'email existe deja
                    header("Location: ../register.php?error=Cet e-mail existe deja veuillez en choisir un autre");
                    exit();
                } else {
                    // on peut inserer l'utilisateur en base de donnees
                    $query_post = "INSERT INTO `user`(nickname, email, password, is_active)
                    VALUES (?,?,?,?)";
                    //on prepare la requete
                    if ($stmt_post = mysqli_prepare($connexion, $query_post)) {
                        // si la requete s'est bien preparee on bind les parametres
                        mysqli_stmt_bind_param(
                            $stmt_post,
                            "sssi",
                            $nickname,
                            $email,
                            $pass_hash, // attention mot de pass hashé
                            $is_active
                        );
                        // on execute la preparation
                        $execute_post = mysqli_stmt_execute($stmt_post);
                        if ($execute_post) {
                            // si on est ici c'est que l'utilisateur a bien ete insere en bdd
                            $stmt_get = mysqli_prepare($connexion, $query);
                            mysqli_stmt_bind_param(
                                $stmt_get,
                                "s",
                                $email
                            );
                            $execute_get = mysqli_stmt_execute($stmt_get);
                            if ($execute_get) {
                                $result_get = mysqli_stmt_get_result($stmt_get);
                                if (mysqli_num_rows($result_get) > 0) {
                                    // ici on recupere les infos de l'user fraichement inscrit , on cree la session
                                    // et on le redirige vers la page d'accueil
                                    $new_user = mysqli_fetch_assoc($result_get);
                                    // on cree la session
                                    $_SESSION['email'] = $new_user['email'];
                                    $_SESSION['nickname'] = $new_user['nickname'];
                                    $_SESSION['id'] = $new_user['id'];
                                    $_SESSION['is_active'] = $new_user['is_active'];
                                    header("location: ../home.php");
                                    exit();
                                }
                            }
                        }
                    }
                }
            } else {
                header("Location: ../register.php?error=Erreur lors de l'execution de la requete");
                exit();
            }
        } else {
            header("Location: ../register.php?error=Erreur lors de la preparation de la requete");
            exit();
        }
    }
} else {

    var_dump("erreur de formulaire");
}
