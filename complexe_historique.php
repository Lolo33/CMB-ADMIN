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

                <div class="ajout-interaction">
                    <form id="form-interaction">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="inputInit" class="form-control">
                                    <optgroup label="Initiateur de l'échange">
                                        <option value="0">Moi</option>
                                        <option value="1">Le Complexe</option>
                                    </optgroup>
                                </select>
                                <select id="inputType" class="form-control">
                                    <optgroup label="Type d'échange">
                                        <?php foreach (getEchangeType() as $unType){ ?>
                                            <option value="<?php echo $unType["id"]; ?>"><?php echo $unType["typeNom"]; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <textarea id="inputResume" class="form-control" rows="3" placeholder="Résumé de l'échange..."></textarea>
                            </div>
                        </div>
                        <div class="form-group align-right petite-marge-top">
                            <button type="reset" class="btn btn-default">Annuler</button>
                            <button type="submit" class="btn btn-success">Ajouter à la liste des intéractions</button>
                        </div>
                    </form>
                </div>

                <div id="liste-interactions">
                    <?php $listeEchanges = getEchanges($idComplexe);
                    if (count($listeEchanges) > 0){
                        foreach ($listeEchanges as $unEchange){
                            if ($unEchange["initiateur"] == 0){ $align = ""; $class = "exp-moi"; $init = "Moi"; }else{ $align = "margin-left: 10%;"; $class = "exp-complexe"; $init = "Complexe"; }?>
                            <div class="grand" style="<?php echo $align; ?>">
                                <div class="interaction <?php echo $class; ?>">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="img/<?php echo $unEchange["typeImg"]; ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <?php echo $init; ?>
                                        </div>
                                        <div class="col-md-2">
                                            Le <strong><?php echo (new DateTime($unEchange["date"]))->format("d-m-Y"); ?></strong>
                                        </div>
                                        <div class="col-md-7">
                                            <?php echo $unEchange["resume"]; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }else{ ?>
                        <h3>Pas d'échanges avec ce complexe pour le moment</h3>
                    <?php } ?>
                    <!---->
                </div>
            </div>
        </div>
    </div>

</div>

<div id="action-info"></div>

<script>
    $("#form-interaction").submit(function (e) {
        e.preventDefault();
        var resume = $("#inputResume").val();
        var initiateur = $("#inputInit").val();
        var type = $("#inputType").val();
        $.post("ajax/ajout_echange.php?complexe=<?php echo $idComplexe; ?>", {resume:resume, init:initiateur, type:type}, function (data) {
            if (data === "ok") {
                fadeAction("Vous avez bien ajouté cette intéraction à la liste.", true);
                location.reload();
            }else
                fadeAction(data, false);
        })
    })
</script>

<?php include "includes/script_bas_page.php"; ?>

<script>
</script>

</body>
</html>