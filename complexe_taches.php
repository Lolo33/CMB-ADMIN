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
    <title>Administration ConnectMyBooking API - <?php echo $complexe->getNom(); ?> - Intéractions avec ce complexe</title>
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
                <h1 class="titre-box">Les tâches à effectuer pour ce complexe</h1>
                <?php
                    $taches = getTachesComplexe($idComplexe);
                    afficherListeTache($taches, false);
                ?>
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