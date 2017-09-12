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
    <?php include "includes/head.php"; ?>
    <title>Administration ConnectMyBooking API - Accueil</title>
    <style>
    </style>
</head>
<body>

<?php include "includes/navbar.php";
$complexe = new \CmbSdk\ClassesMetiers\Complexe();
try {
    $complexe = $CmbApi->ComplexesAction->Get($idComplexe);
}catch(\CmbSdk\Exceptions\ReponseException $ex){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
    header("Location: accueil.php");
}
?>

<div class="container-fluid">

    <h1 class="text-center bold nom-complexe">
        <?php echo $complexe->getNom() . " <span class='ville-complexe'>( " . $complexe->getCoordonnees()->getVille() . " )</span>"; ?>
    </h1>

    <div class="row" style="margin: 0 50px;">
        <div class="col-md-3">
            <div class="box contour-gris grand" id="nav-tool" style="margin: 40px 0 70px;">
                <h1 class="titre-box">Navigation</h1>

                <div class="list-group">
                    <a href="complexe_accueil?complexe=<?php echo $idComplexe; ?>" class="list-group-item active">
                        Le Complexe
                    </a>
                    <a href="complexe_historique?complexe=<?php echo $idComplexe; ?>" class="list-group-item">
                        Historique
                    </a>
                    <a href="#" class="list-group-item disabled">
                        Documents
                    </a>
                    <a href="#" class="list-group-item disabled">
                        Réservations
                    </a>
                    <a href="#" class="list-group-item disabled">
                        Plages horaires
                    </a>
                    <a href="#" class="list-group-item disabled">
                        Tarifs
                    </a>
                    <a href="#" class="list-group-item disabled">
                        Comissions
                    </a>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="box contour-gris grand" style="margin: 40px 0 70px;">
                <h1 class="titre-box" style="margin-bottom: 20px;">Informations du complexe</h1>
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
