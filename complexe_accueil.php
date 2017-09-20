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

$idComplexe = 0;

if (isset($_GET["complexe"]) && !empty($_GET["complexe"]))
    $idComplexe = htmlspecialchars(trim($_GET["complexe"]));
else
    header("Location: accueil.php");

?>

<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.php";
    $complexe = new \CmbSdk\ClassesMetiers\Complexe();
    $complexe_bdd = null;
    try {
        $complexe = $CmbApi->ComplexesAction->Get($idComplexe);
        $complexe_bdd = getComplexe($idComplexe);
    }catch(\CmbSdk\Exceptions\ReponseException $ex){
        echo "<script>
                alert(\"Erreur de réponse HTTP: " . $ex->getReponse() . "\\n" . $ex->getMessage() . "\");
                document.location.replace('accueil.php');
            </script>";
        //header("Location: accueil.php");
    }
    $systeme = $complexe_bdd["systeme_resa_id"];
    if ($systeme == null)
        $systeme = "<span class='red'>[NON]</span>";
    else
        $systeme = '<span class="blue">' . getSystemeResa($systeme)["nom"] . '</span>';
    ?>
    <title>Administration ConnectMyBooking API - <?php echo $complexe->getNom(); ?> - Informations</title>
    <style>
    </style>
</head>
<body>

<?php include "includes/navbar.php"; ?>

<div class="container-fluid">

    <h1 class="text-center bold nom-complexe">
        <?php echo $complexe->getNom() . " <span class='ville-complexe'>( " . $complexe->getCoordonnees()->getVille() . " )</span>"; ?>
    </h1>

    <div class="row" style="margin: 0 50px;">
        <div class="col-md-3">
            <?php include "complexe_navigation.php"; ?>
        </div>
        <div class="col-md-9">
            <div class="box contour-gris grand" style="margin: 40px 0 70px;">
                <h1 class="titre-box" style="margin-bottom: 40px;">Informations du complexe</h1>
                <div class="conteneur-info">
                    <div class="row">
                        <div class="col-md-3">Nom:</div>
                        <div class="col-md-3"><strong><?php echo $complexe->getNom(); ?></strong></div>
                        <div class="col-md-3">Adresse ligne 1:</div>
                        <div class="col-md-3"><strong><?php echo $complexe->getCoordonnees()->getAdresseLigne1(); ?></strong></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">E-mail:</div>
                        <div class="col-md-3"><strong><?php echo $complexe->getCoordonnees()->getMail(); ?></strong></div>
                        <div class="col-md-3">Adresse ligne 2::</div>
                        <div class="col-md-3">
                            <strong><?php
                                $adresse_l2 = $complexe->getCoordonnees()->getAdresseLigne2();
                                if (empty($adresse_l2)){ echo "[Vide]"; }else{ echo $adresse_l2; }
                            ?></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">N° telephone:</div>
                        <div class="col-md-3"><strong><?php echo $complexe->getCoordonnees()->getTelephone(); ?></strong></div>
                        <div class="col-md-3">Code Postal:</div>
                        <div class="col-md-3"><strong><?php echo $complexe->getCoordonnees()->getCodePostal(); ?></strong></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Nbr. Terrains:</div>
                        <div class="col-md-3"><strong><?php echo count($complexe->getListeTerrains()); ?></strong></div>
                        <div class="col-md-3">Ville:</div>
                        <div class="col-md-3"><strong><?php echo $complexe->getCoordonnees()->getVille(); ?></strong></div>
                    </div>
                </div>
                <hr class="separateur-info">
                <div class="conteneur-info">
                    <div class="row">
                        <div class="col-md-3">Site du complexe :</div>
                        <div class="col-md-9">
                            <strong>
                                <?php if (!empty($complexe_bdd["site"])) {
                                    echo '<a target="_blank" href="'.$complexe_bdd['site'].'">'.$complexe_bdd["site"].'</a>';
                                }else {
                                    echo "[Pas de site]";
                                } ?>
                            </strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Système de réservation:</div>
                        <div class="col-md-3"><strong><?php echo $systeme; ?></strong></div>
                        <div class="col-md-3">Client CMB:</div>
                        <div class="col-md-3"><strong><?php if ($complexe_bdd["is_client_cmb"] == 1){ echo "<span class='green'>[OUI]</span>"; }else{ echo "<span class='red'>[NON]</span>"; }  ?></strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="action-info"></div>

<?php include "includes/script_bas_page.php"; ?>

<script>

</script>

</body>
</html>
