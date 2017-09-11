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
        </div>

    </div>
</div>

<div id="action-info"></div>

<?php include "includes/script_bas_page.php"; ?>

<script>

</script>

</body>
</html>
