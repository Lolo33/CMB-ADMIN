<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 13/09/2017
 * Time: 11:22
 */

include '../includes/init.php';
$db = getConnexion();

if (isset($_GET["complexe"])) {

    $idComplexe = htmlspecialchars(trim($_GET["complexe"]));

    if (isset($_POST["resume"]) && isset($_POST["init"]) && isset($_POST["type"])) {

        $resume = htmlspecialchars(trim($_POST["resume"]));
        $init = htmlspecialchars(trim($_POST["init"]));
        $type = htmlspecialchars(trim($_POST["type"]));

        if (!empty($resume) && !empty($type)) {
            $req = $db->prepare("INSERT INTO echange (type_id, date, initiateur, complexe_id, resume) VALUES (:type, NOW(), :init, :complexe, :resume)");
            $req->bindValue(":type", $type, PDO::PARAM_INT);
            $req->bindValue(":init", $init, PDO::PARAM_BOOL);
            $req->bindValue(":complexe", $idComplexe, PDO::PARAM_INT);
            $req->bindValue(":resume", $resume, PDO::PARAM_STR);
            if ($req->execute())
                echo "ok";
            else
                echo "Une erreur innatendue est survenue";
        }else{
            echo "Vous devez remplir tous les champs";
        }

    }else{
        echo "Des données du formulaire ne sont pas passées correctement";
    }
}else{
    echo "Le complexe ciblé n'a pas été trouvé";
}