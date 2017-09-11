<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 11/09/2017
 * Time: 16:48
 */

include "../includes/init.php";
include "../api_conf.php";
$db = getConnexion();

if (!estConnecte())
    header("Location: index.php");

$session_token = unserialize($_SESSION["token"]);

if (isset($_POST["date"]) && isset($_POST["descr"])){
    $date = htmlspecialchars(trim($_POST["date"]));
    $descr = htmlspecialchars(trim($_POST["descr"]));
    if (!empty($date) && !empty($descr)){
        if (preg_match('#^([0-9]{2})([/-])([0-9]{2})\2([0-9]{4})$#', $date)){

            $date = convertDateToEnglish($date);

            $req = $db->prepare("INSERT INTO taches (utilisateur_id, date, description) VALUES (:id_user, :dat, :descr)");
            $req->bindValue(":id_user", $session_token->getApiUser()->getId(), PDO::PARAM_INT);
            $req->bindValue(":dat", $date, PDO::PARAM_STR);
            $req->bindValue(":descr", $descr, PDO::PARAM_STR);
            if ($req->execute())
                echo "ok";
            else
                echo "Une erreur SQL s'est produite pendant l'ajout";

        }else{
            echo "Le format de date saisi est incorrect. Veuillez saisir la date au format dd-mm-yyyy";
        }
    }else{
        echo "Vous devez remplir tous les champs";
    }
}