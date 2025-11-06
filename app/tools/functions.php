<?php

/**
 *  methode qui permet de valider et securiser les inputs des formulaires
 * @param string $data
 * @return string $data
 */
function validate($data)
{
    // $data = htmlspecialchars($data); // convertit les caracteres speciaux en entites html
    // $data = stripslashes($data); // supprime les antislashs
    // $data = trim($data); // supprime les espaces avant et apres la chaine de caractere
    
    return trim(stripslashes(htmlspecialchars($data)));
}

/**
 * Méthode qui verifie la conformité du mot de passe
 * 1 majuscule, 1 minuscule, 1 chiffre , et au moins 8 caracteres
 * @param string $password
 * @return bool 
 */
function check_password($password){
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    return preg_match($regex, $password);
}