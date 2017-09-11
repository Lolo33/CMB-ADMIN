<?php
include "includes/init.php";
if (estConnecte())
    header("Location: accueil.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.php"; ?>
    <title>Administration ConnectMyBooking API - Se connecter</title>
</head>
<body>

    <div class="container-fluid">

        <h2 id="nom-site" class="marge-top">ConnectMyBooking API</h2>
        <div class="box petit contour-vert marge-top">
            <form id="form-connexion" class="form-horizontal">
                <fieldset>
                    <legend>Acceder au back-office</legend>
                    <div class="form-group">
                        <div class="zone-erreur"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputPseudo" placeholder="Votre ClientID">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Votre mot de passe">
                    </div>
                    <div class="form-group align-right">
                        <button type="reset" class="btn btn-default">Annuler</button>
                        <button type="submit" class="btn btn-success">Connexion</button>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>


    <script>
        $("#form-connexion").submit(function (e) {
            e.preventDefault();
            var pseudo = $("#inputPseudo").val();
            var pass = $("#inputPassword").val();
            $.post("ajax/connexion_check.php", {pseudo:pseudo, pass:pass}, function (data) {
                $(".zone-erreur").html(data).slideDown();
            });
        });
    </script>

</body>
</html>