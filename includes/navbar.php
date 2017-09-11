<?php include "api_conf.php"; ?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CMB Administration</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="accueil.php">Accueil<span class="sr-only">(current)</span></a></li>

                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>-->
            </ul>

            <form class="navbar-form navbar-left" method="post" action="complexe_historique" role="search">
                <div class="form-group">
                    <select name="complexe" class="form-control" id="select-complexe">
                        <option selected readonly>Choisir un complexe</option>
                        <?php
                        try {
                            $listeComplexes = $CmbApi->ComplexesAction->GetAll();
                            foreach ($listeComplexes as $unComplexe) {
                                echo '<option value=""' . $unComplexe->getId() . '" id="' . $unComplexe->getId() . '">' . $unComplexe->getNom() . '</option>';
                            }
                        }catch(\CmbSdk\Exceptions\ReponseException $ex){
                            echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
                                "Message : " . $e->getMessage();
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Gérer ce complexe</button>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="deconnexion">Deconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>