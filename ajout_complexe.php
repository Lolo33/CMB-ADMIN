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
$ajout_gerant = false;
if (isset($_GET["complexe"]) && !empty($_GET["complexe"])) {
    $idComplexe = htmlspecialchars(trim($_GET["complexe"]));
    $ajout_gerant = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.php"; ?>
    <title>Administration ConnectMyBooking API - Ajouter un complexe</title>
    <style>
    </style>
</head>
<body>

<?php include "includes/navbar.php"; ?>

<div class="container-fluid">

    <div class="box contour-gris moyen" style="margin: 40px auto 70px;">
        <h1 class="titre-box">Ajouter un complexe</h1>

        <div class="form-complexe">
            <form id="form-complexe" style="<?php if ($ajout_gerant){ echo "display:none;";} ?>" method="post">
                <h4>Remplissez le formulaire ci-dessous pour ajouter un complexe :</h4>
                <div class="zone-erreur"></div>

                <div class="form-group">
                    <input class="form-control input-complexe" type="text" id="inputNom" placeholder="Nom du complexe *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="text" id="inputAdresseL1" placeholder="Adresse ligne 1 *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="text" id="inputAdresseL2" placeholder="Adresse ligne 2" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="tel" id="inputCodePostal" placeholder="Code postal *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="text" id="inputVille" placeholder="Ville *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="email" id="inputMail" placeholder="Adresse de courrier électronique (e-mail) *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="tel" id="inputTelephone" placeholder="Numéro de télephone *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="url" id="inputURL" placeholder="URL du site du complexe (https://example.fr)" />
                </div>

                <div class="form-group">
                    <select class="form-control input-complexe" id="inputSystemeResa" >
                        <option value="null">Pas de système de réservation</option>
                        <?php foreach (getListeSystemeResa() as $unSysteme){ ?>
                            <option value="<?php echo $unSysteme["id"]; ?>"><?php echo $unSysteme["nom"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="checkbox">
                    <label>
                        <input id="chkClientCmb" type="checkbox"> Client ConnectMyBooking
                    </label>
                </div>

                <div class="form-group align-right">
                    <button type="reset" class="btn btn-default">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter ce complexe <span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>

            </form>

            <form id="form-gerant" style="<?php if (!$ajout_gerant){ echo "display:none;";} ?>">
                <h4>Ajoutez un gérant à ce complexe</h4>
                <div class="form-group">
                    <input class="form-control input-complexe" type="text" id="inputUsername" placeholder="Nom d'utilisateur *" />
                </div>
                <div class="form-group">
                    <input class="form-control input-complexe" type="password" id="inputPassword" placeholder="Mot de passe *" />
                </div>
                <div class="form-group align-right">
                    <button type="reset" class="btn btn-default">Annuler</button>
                    <button type="button" class="btn btn-primary">Revenir à l'accueil</button>
                    <button type="submit" class="btn btn-success">Ajouter ce gérant au complexe</button>
                </div>
            </form>

        </div>

    </div>
</div>

<div id="action-info"></div>

<?php include "includes/script_bas_page.php"; ?>
<?php if($ajout_gerant){ ?>
    <script>
        $("#form-gerant").submit(function (e) {
            e.preventDefault();
            var id_complexe = <?php echo $idComplexe; ?>
            var username = $("#inputUsername").val();
            var pass = $("#inputPassword").val();
            $.post("ajax/ajouter_gerant.php", {id:id_complexe, username:username, pass:pass}, function (data) {
                if (data === "ok") {
                    fadeAction("Vous avez bien ajouté ce complexe", true);
                    location.replace("accueil.php");
                }else
                    fadeAction(data, false);
            });
        });
    </script>
<?php }else{ ?>
    <script>
        $("#form-complexe").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var nom = $("#inputNom").val();
            var adresseL1 = $("#inputAdresseL1").val();
            var adresseL2 = $("#inputAdresseL2").val();
            var cp = $("#inputCodePostal").val();
            var ville = $("#inputVille").val();
            var mail = $("#inputMail").val();
            var tel = $("#inputTelephone").val();
            var systeme = $("#inputSystemeResa").val();
            var is_client = $("#chkClientCmb").prop("checked");
            var url = $("#inputURL").val();
            $.post("ajax/ajouter_complexe.php", {nom:nom, adresseL1:adresseL1, adresseL2:adresseL2, cp:cp, ville:ville, mail:mail, tel:tel, systeme:systeme, url:url, is_client:is_client}, function (data) {
                if (data.indexOf("ok-") !== -1) {
                    fadeAction("Vous avez bien ajouté ce complexe", true);
                    form.hide();
                    var id_complexe = data.substr(3);
                    console.log(id_complexe);
                    var form_gerant = $("#form-gerant");
                    form_gerant.animate({width:'toggle'},350);
                    form_gerant.submit(function (e) {
                        e.preventDefault();
                        var username = $("#inputUsername").val();
                        var pass = $("#inputPassword").val();
                        $.post("ajax/ajouter_gerant.php", {id:id_complexe,username:username, pass:pass}, function (data) {
                            if (data === "ok") {
                                fadeAction("Vous avez bien ajouté ce complexe", true);
                                location.replace("accueil.php");
                            }else
                                fadeAction(data, false);
                        });
                    });
                }else
                    fadeAction(data, false);
            });
        });
    </script>
<?php } ?>

</body>
</html>
