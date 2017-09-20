<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 12/09/2017
 * Time: 02:06
 */

include '../includes/init.php';
$db = getConnexion();

if (isset($_POST["recentes"]) && isset($_POST["anciennes"]) && isset($_POST["nofinished"]) && isset($_POST["finished"]) && isset($_POST["search"])){

    $recentes = htmlspecialchars(trim($_POST["recentes"]));
    $anciennes = htmlspecialchars(trim($_POST["anciennes"]));
    $no_finished = htmlspecialchars(trim($_POST["nofinished"]));
    $finished = htmlspecialchars(trim($_POST["finished"]));
    $search = htmlspecialchars(trim($_POST["search"]));

    $date = "";
    $etat = "";

    if ($recentes == "false" && $anciennes == "false"){
        echo "<h3>Pas de tâches à pour le moment.</h3>";
        die();
    }else {
        if ($recentes != "true" || $anciennes != "true") {
            if ($recentes == "true")
                $date = "taches.date >= DATE( NOW() )";
            if ($anciennes == "true")
                $date = "taches.date < DATE( NOW() )";
        }
    }
    if ($no_finished == "false" && $finished == "false"){
        echo "<h3>Pas de tâches à pour le moment.</h3>";
        die();
    }else {
        if ($no_finished != "true" || $finished != "true") {
            if ($no_finished == "true")
                $etat = "fait = 0";
            elseif ($finished == "true")
                $etat = "fait = 1";
        }
    }

    if ($search != "") {
        $search = "'%" . $search . "%'";
        $fin_requete = "WHERE (taches.date LIKE ".$search." OR taches.description LIKE ".$search . ") ";
        if ($etat != "" && $date != ""){
            $fin_requete .= "AND " . $date . " AND " . $etat;
        }elseif ($date == "" && $etat != ""){
            $fin_requete .= "AND " . $etat;
        }elseif ($etat == "" && $date != ""){
            $fin_requete .= "AND " . $date;
        }elseif ($etat == "" && $date == "" && $search == "''"){
            $fin_requete = " ";
        }
    }else {
        $search = "''";
        $fin_requete = "WHERE ";
        if ($etat != "" && $date != ""){
            $fin_requete .= $date . " AND " . $etat;
        }elseif ($date == "" && $etat != ""){
            $fin_requete .= $etat;
        }elseif ($etat == "" && $date != ""){
            $fin_requete .= $date;
        }elseif ($etat == "" && $date == "" && $search == "''"){
            $fin_requete = " ";
        }
    }

    $req = $db->query("SELECT * FROM taches INNER JOIN utilisateur_api ON taches.utilisateur_id = utilisateur_api.id " . $fin_requete . " ORDER BY taches.date, fait");
    $req->execute();
    if ($req->rowCount() == 0){
        echo "<h3>Pas de tâches à faire pour le moment.</h3>";
        die();
    }
    $listeTaches = $req->fetchAll();
    afficherListeTache($listeTaches);
}