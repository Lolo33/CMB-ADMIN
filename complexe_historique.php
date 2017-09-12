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
                    <a href="complexe_accueil?complexe=<?php echo $idComplexe; ?>" class="list-group-item">
                        Le Complexe
                    </a>
                    <a href="complexe_historique?complexe=<?php echo $idComplexe; ?>" class="list-group-item active">
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
                <h1 class="titre-box">Historique des intéractions</h1>
                <div>
                    <h3></h3>
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
