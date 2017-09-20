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
        try {
            $complexe = $CmbApi->ComplexesAction->Get($idComplexe);
        }catch(\CmbSdk\Exceptions\ReponseException $ex){
            echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
                "Message : " . $e->getMessage();
            header("Location: accueil.php");
        }
    ?>
    <title>Administration ConnectMyBooking API - <?php echo $complexe->getNom(); ?> - Historique des échanges</title>
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
                <h1 class="titre-box">Historique de navigation du complexe</h1>

                <?php $liste_navig = getHistorique($idComplexe);
                if (count($liste_navig) > 0) {
                    $liste_temps_passe = [];
                    foreach ($liste_navig as $item)
                        if ($item["fin_visite"] != null)
                            $liste_temps_passe[] = (new DateTime($item["debut_visite"]))->diff(new DateTime($item["fin_visite"])); ?>
                    <h3>Temps total passé sur le site : <strong><?php echo format_heure(calculerTempsTotal($liste_temps_passe)); ?></strong></h3>
                    <div id="liste-navig">
                    <?php foreach ($liste_navig as $unePage) { ?>
                        <div class="row" style="background: #f5f5f5;margin-bottom: 5px; padding: 5px;">
                            <div class="col-lg-3">
                                <?php
                                echo "Le " . (new DateTime($unePage["debut_visite"]))->format("d-m-Y");
                                if ($unePage["fin_visite"] == null) {
                                    echo " <span class='red bold'>Fin de visite</span>";
                                } else {
                                    $temps = (new DateTime($unePage["debut_visite"]))->diff(new DateTime($unePage["fin_visite"]));
                                    echo " [<strong>" . format_heure($temps->h . ":" . $temps->i . ":" . $temps->s) . "</strong>] ";
                                } ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $unePage["url"]; ?>
                            </div>
                            <div class="col-lg-3">
                                <?php echo $unePage["ip"]; ?>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                <?php }else{ ?>
                    <h3 style="margin-top: 40px;">Ce complexe n'a pas encore navigué sur son espace dédié.</h3>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<div id="action-info"></div>

<script>
</script>

<?php include "includes/script_bas_page.php"; ?>

<script>
</script>

</body>
</html>