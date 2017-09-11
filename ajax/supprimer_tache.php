<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 11/09/2017
 * Time: 18:12
 */

include "../includes/init.php";

$db = getConnexion();

if (isset($_POST["id"])) {

    $id = htmlspecialchars(trim($_POST["id"]));

    if (!empty($id)) {

        $req = $db->prepare("DELETE FROM taches WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        if ($req->execute())
            echo "ok";

    }


}