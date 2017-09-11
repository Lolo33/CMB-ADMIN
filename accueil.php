<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 11/09/2017
 * Time: 12:36
 */
include "includes/init.php";
if (!estConnecte())
    header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.php"; ?>
    <title>Administration ConnectMyBooking API - Accueil</title>
    <style>
    </style>
</head>
<body>

<?php include "includes/navbar.php"; ?>

<div class="container-fluid">

    <div class="box contour-gris moyen" style="margin: 40px auto 70px;">
        <h1 class="titre-box">Liste des tâches à effectuer</h1>

        <div class="row">
            <div class="col-lg-8">
                <h5>Ci-dessous un récapitulatif des tâches à effectuer dans l'ordre chronologique à partir d'aujourd'hui :</h5>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-success grand" id="btn-new-tache"><span class="glyphicon glyphicon glyphicon-plus"></span> Nouvelle tâche <span class="caret" id="fleche-add"></span> </button>
            </div>
        </div>

        <div class="form-tache">
            <h4>Ajouter une tâche :</h4>
            <form id="form-tache">
                <div class="zone-erreur"></div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span>
                                <input type="text" id="inputDate" placeholder="Selectionner une date" class="form-control" style="height: 60px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <textarea class="form-control" rows="2" id="inputDescr" placeholder="Contenu de la tâche" style="height: 60px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <h5>La date saisie doit être au format dd-mm-yyyy.</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group align-right">
                            <button type="reset" class="btn btn-default">Annuler</button>
                            <button type="submit" class="btn btn-success">Ajouter à la liste des tâches</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div id="liste-taches">
            <?php foreach (getTaches() as $uneTache){ ?>
            <div class="tache" id="t-<?php echo $uneTache[0]; ?>">
                <div class="row">
                    <div class="col-lg-1">
                        <input type="checkbox" <?php if ($uneTache["fait"] == 1){ echo 'checked'; } ?> class="checkbox-tache" id="<?php echo $uneTache[0]; ?>">
                    </div>
                    <div class="col-lg-3 date-tache">
                        Le: <strong><?php echo (new DateTime($uneTache["date"]))->format("d-m-Y"); ?></strong>
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
                        <button class="btn btn-danger grand btn-suppr-tache" id="d-<?php echo $uneTache[0]; ?>"><span class="glyphicon glyphicon-trash"></span>  Supprimer</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>

<div id="action-info"></div>

<?php include "includes/script_bas_page.php"; ?>

<script>
    $("#btn-new-tache").click(function () {
        var form = $(".form-tache");
        if (form.css("display") == "none") {
            form.show();
            $("#fleche-add").css("visibility", "visible");
            $(this).removeClass("btn-success").addClass("btn-default");
            $("html").niceScroll();
        }else {
            form.hide();
            $("#fleche-add").css("visibility", "hidden");
            $(this).removeClass("btn-default").addClass("btn-success");
            $("body").niceScroll();
        }
    });

    $("#form-tache").submit(function (e) {
        e.preventDefault();
        var date = $("#inputDate").val();
        var descr = $("#inputDescr").val();
        $.post("ajax/ajouter_tache.php", {date:date, descr:descr}, function (data) {
            if (data === "ok") {
                fadeAction("Vous avez bien ajouté cette tâche à la liste.", true);
                location.reload();
            }else
                fadeAction(data, false);
        });
    });

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
           }else
               fadeAction("La tâche n'a pas pu être supprimée", false);
       });
    });

    $( "#inputDate" ).datepicker({
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd-mm-yy'
    });
</script>

</body>
</html>
