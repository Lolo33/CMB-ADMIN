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
        echo 'active';
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

function format_heure($heure){
    $heure_tab = explode(":", $heure);
    $heure = $heure_tab[0];
    $minutes = $heure_tab[1];
    $sec = $heure_tab[2];
    if (strlen($heure) == 1)
        $heure = "0" . $heure;
    if (strlen($minutes) == 1)
        $minutes = "0" . $minutes;
    if (strlen($sec) == 1)
        $sec = "0" . $sec;
    return $heure . "h" . $minutes . "m" . $sec . "s";
}
function calculerTempsTotal($liste_intervals){
    $sec = 0;
    $mins = 0;
    $hrs = 0;
    foreach ($liste_intervals as $interval){
        $sec += $interval->s;
        $mins += $interval->i;
        $hrs += $interval->h;
        if ($sec >= 60){
            $mins += 1;
            $sec -= 60;
        }
        if ($mins >= 60){
            $hrs += 1;
            $mins -= 60;
        }
    }
    $resultat = $hrs . ":" . $mins . ":" . $sec;
    return $resultat;
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

function afficherListeTache($listeTache, $afficherLieu = true){
    echo '<div id="liste-taches">';
    if (!empty($listeTache)) {
        foreach ($listeTache as $uneTache) {
            $checked = "";
            if ($uneTache["fait"] == 1) {
                $checked = "checked";
            }
            $complexe = getComplexe($uneTache["complexe_id"]);
            $nomComplexe = $complexe["lieu_nom"];
            $labelComplexe = "";
            // Affiche le complexe sous forme de lien si la tache est associée
            if ($nomComplexe != "" && $nomComplexe != null){
                if ($afficherLieu) {
                    $labelComplexe = '<span class="glyphicon glyphicon-map-marker"></span>
                    <strong>
                        <a href="complexe_accueil?complexe=' . $uneTache["complexe_id"] . '">
                        ' . $nomComplexe . '
                        </a>
                    </strong>';
                }else{
                    $labelComplexe = '<span class="glyphicon glyphicon-map-marker"></span>
                    <strong>
                        <a href="complexe_accueil?complexe=' . $uneTache["complexe_id"] . '">
                        Ici
                        </a>
                    </strong>';
                }
            }
            $labelType = "";
            if ($uneTache["type_echange_id"] != null){
                $type = getEchangeType($uneTache["type_echange_id"]);
                $labelType = "<img src='img/".$type['typeImg']."' height='20' /> <strong>" . $type["typeNom"] . "</strong>";
            }
            $categ = getTacheCategorie($uneTache["categorie_id"]);
            echo '<div class="tache" id="t-' . $uneTache[0] . '">
                <div class="row">
                    <div class="col-lg-1">
                        <input type="checkbox" ' . $checked . ' class="checkbox-tache" id="'.$uneTache[0].'">
                    </div>
                    <div class="col-lg-4 date-tache">  
                        <h5 style="margin-top:0;"><strong class="'.$categ["cat_color"].'"> ' . $categ["cat_nom"] . ' </strong></h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="glyphicon glyphicon-calendar"></span> <strong>' . (new DateTime($uneTache["date"]))->format("d-m-Y") . '</strong><br />
                            </div>
                            <div class="col-lg-6">
                            ' . $labelComplexe . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="glyphicon glyphicon-user"></span> <strong>' . $uneTache["user_client_id"] . '</strong>
                            </div>
                            <div class="col-lg-6">
                            ' . $labelType . '
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 descr-tache">
                        ' . $uneTache["description"] . '
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-danger grand btn-suppr-tache" id="d-' . $uneTache[0] . '">
                            <span class="glyphicon glyphicon-trash"></span> Supprimer
                        </button>
                    </div>
                </div>
            </div>';
        }
    }else{
        echo '<h3>Pas de tâches à faire pour le moment.</h3>';
    }
    echo '</div>
    <script>
        $(".checkbox-tache").change(function () {
           var id = $(this).attr("id");
           var etat = $(this).prop("checked");
           var state = 0;
           if (etat === true)
               state = 1;
           $.post("ajax/changer_tache.php", {id:id, etat:state}, function (data) {
               if (data === "ok")
                   fadeAction("Le changement d\'état a bien été effectué", true);
               else
                   fadeAction("Le changement d\'état n\'a pas pu s\'opérer", false);
           })
        });
        $(".btn-suppr-tache").click(function () {
           var id = $(this).attr("id").substr(2);
           $.post("ajax/supprimer_tache.php", {id:id}, function (data) {
               if (data === "ok") {
                   fadeAction("La tâche à bien été supprimée", true);
                   $("#t-" + id).remove();
                   if ($(".tache").length === 0)
                        $("#liste-taches").html("<h3>Pas de tâches à pour le moment.</h3>").slideDown();
               }else
                   fadeAction("La tâche n\'a pas pu être supprimée", false);
           });
        });
    </script>';
}

// Taches
function getTaches(){
    $db = getConnexion();
    $req = $db->query("SELECT * FROM taches INNER JOIN utilisateur_api ON taches.utilisateur_id = utilisateur_api.id ORDER BY taches.fait, taches.date");
    $req->execute();
    $rep = $req->fetchAll();
    return $rep;
}
function getTachesComplexe($id_complexe){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM taches INNER JOIN utilisateur_api ON taches.utilisateur_id = utilisateur_api.id WHERE complexe_id = :complexe ORDER BY taches.fait, taches.date");
    $req->bindValue(":complexe", $id_complexe, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll();
}
// CategoriesTaches
function getTachesCategories(){
    $db = getConnexion();
    $req = $db->query("SELECT * FROM taches_categories;");
    $req->execute();
    return $req->fetchAll();
}
function getTacheCategorie($id){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM taches_categories WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}

// Echanges
function getEchangeType($id) {
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM echange_type WHERE id = :id;");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}
function getEchangesTypes() {
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

// Historique Navigation
function getHistorique($id_complexe){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM historique_navigation_complexe WHERE complexe_id = :id ORDER BY debut_visite DESC");
    $req->bindValue(":id", $id_complexe, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll();
}

// Système resa
function getListeSystemeResa(){
    $db = getConnexion();
    $req = $db->query("SELECT * FROM systeme_resa");
    $req->execute();
    return $req->fetchAll();
}
function getSystemeResa($id){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM systeme_resa WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}

// Complexe
function getComplexe($id_complexe){
    $db = getConnexion();
    $req = $db->prepare("SELECT * FROM complexe WHERE id = :id");
    $req->bindValue(":id", $id_complexe, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}