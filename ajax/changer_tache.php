<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 11/09/2017
 * Time: 17:48
 */

include "../includes/init.php";

$db = getConnexion();

if (isset($_POST["etat"]) && isset($_POST["id"])){

    $is_checked = htmlspecialchars(trim($_POST["etat"]));
    $id = htmlspecialchars(trim($_POST["id"]));

    if (!empty($id)){

        $req = $db->prepare("UPDATE taches SET fait = :etat WHERE id = :id");
        $req->bindValue(":etat", $is_checked, PDO::PARAM_BOOL);
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        if ($req->execute() === true)
            echo "ok";

    }

}