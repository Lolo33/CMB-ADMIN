<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 11/09/2017
 * Time: 00:15
 */

use \CmbSdk\CmbApi;

include "database.php";

session_start();

function estConnecte()
{
    if (isset($_SESSION["token"]) && !empty($_SESSION["token"]))
        return true;
    return false;
}

function activeMenuIfContain($chaine){
    $url = $_SERVER["REQUEST_URI"];
    if (stripos($url, $chaine))
        echo 'class="active"';
    else
        echo "";
}

function messageForm($message, $success = false){
    if ($success) {
        $class = "alert-success";
        $intro = "Bien joué";
    }else {
        $class = "alert-danger";
        $intro = "Erreur";
    }
    echo '<div class="alert alert-dismissible '.$class.'">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>'.$intro.'! </strong> '.$message.'
    </div>';
}

function convertDateToEnglish($date){
    $date_tab = explode("-", $date);
    return $new_date = $date_tab[2] . "-" . $date_tab[1] . "-" . $date_tab[0];
}

function getTaches(){
    $db = getConnexion();
    $req = $db->query("SELECT * FROM taches INNER JOIN utilisateur_api ON taches.utilisateur_id = utilisateur_api.id WHERE taches.date >= DATE( NOW() ) ORDER BY taches.date");
    $req->execute();
    $rep = $req->fetchAll();
    return $rep;
}

function getEchangeType() {
    $db = getConnexion();
    $req = $db->query("SELECT * FROM echange_type;");
    $req->execute();
    return $req->fetchAll();
}

function getEchanges($id_complexe){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM echange INNER JOIN echange_type ON echange.type_id = echange_type.id WHERE complexe_id = :id ORDER BY echange.date DESC");
    $req->bindValue(":id", $id_complexe, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll();
}

function exist($table, $champ, $valeur){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM " . $table . " WHERE ".$champ." = :valeur");
    $req->bindValue(":valeur", $valeur, PDO::PARAM_STR);
    $req->execute();
    if ($req->rowCount() > 0)
        return true;
    return false;
}