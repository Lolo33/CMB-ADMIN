<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 14/09/2017
 * Time: 04:47
 */

include "../includes/init.php";
$db = getConnexion();

if (!empty($_POST)) {

    $nom = htmlspecialchars(trim($_POST["username"]));
    $pass = htmlspecialchars(trim($_POST["pass"]));
    $idComplexe = htmlspecialchars(trim($_POST["id"]));

    if (!exist("complexe_gerant", "gerant_username", $nom)) {
        //$pass = password_hash($pass, PASSWORD_BCRYPT);
        $req_ajout = $db->prepare("INSERT INTO complexe_gerant (complexe_id, gerant_username, gerant_password) VALUES (:id_complexe, :username, :pass)");
        $req_ajout->bindValue(":id_complexe", $idComplexe, PDO::PARAM_INT);
        $req_ajout->bindValue(":username", $nom, PDO::PARAM_STR);
        $req_ajout->bindValue(":pass", $pass, PDO::PARAM_STR);
        if ($req_ajout->execute())
            echo "ok";
        else
            echo "Une erreur innatendue est survenue";
    }else{
        echo "Ce nom d'utilisateur est déja utilisé par un gérant";
    }

}