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
        echo "<h3>Pas de tâches à pour le moment.</h3>";
        die();
    }
    while ($uneTache = $req->fetch()){ ?>
        <div class="tache" id="t-<?php echo $uneTache[0]; ?>">
            <div class="row">
                <div class="col-lg-1">
                    <input type="checkbox" <?php if ($uneTache["fait"] == 1) {
                        echo 'checked';
                    } ?> class="checkbox-tache" id="<?php echo $uneTache[0]; ?>">
                </div>
                <div class="col-lg-3 date-tache">
                    Pour le: <strong><?php echo (new DateTime($uneTache["date"]))->format("d-m-Y"); ?></strong>
                </div>
                <div class="col-lg-8 descr-tache">
                    <?php echo $uneTache["description"]; ?>
                </div>
            </div>
            <hr class="separateur-tache">
            <div class="row petite-marge-top">
                <div class="col-lg-6">
                    Posté par : <strong><?php echo $uneTache["user_client_id"]; ?></strong>
                </div>
                <div class="col-lg-3">
                    <!--<button class="btn btn-warning grand"><span class="glyphicon glyphicon-ok"></span>  A Faire</button>-->
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-danger grand btn-suppr-tache" id="d-<?php echo $uneTache[0]; ?>">
                        <span class="glyphicon glyphicon-trash"></span> Supprimer
                    </button>
                </div>
            </div>
        </div>
        <script>

            $(".checkbox-tache").change(function () {
                var id = $(this).attr("id");
                var etat = $(this).prop("checked");
                var state = 0;
                if (etat === true)
                    state = 1;
                $.post("ajax/changer_tache.php", {id:id, etat:state}, function (data) {
                    if (data === "ok")
                        fadeAction("Le changement d'état a bien été effectué", true);
                    else
                        fadeAction("Le changement d'état n'a pas pu s'opérer", false);
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
                        fadeAction("La tâche n'a pas pu être supprimée", false);
                });
            });
        </script>
    <?php }
    }