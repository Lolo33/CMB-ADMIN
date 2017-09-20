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
                <li class="<?php activeMenuIfContain("/accueil"); ?>">
                    <a href="accueil.php"><span class="glyphicon glyphicon-home"></span> Accueil<span class="sr-only">(current)</span></a>
                </li>
                <li class="<?php activeMenuIfContain("/ajout_complexe"); ?>">
                    <a href="ajout_complexe.php"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter un complexe<span class="sr-only">(current)</span></a>
                </li>

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

            <form class="navbar-form navbar-left" method="get" action="complexe_accueil" role="search">
                <div class="form-group">
                    <select name="complexe" class="form-control" id="select-complexe">
                        <?php
                        $listeComplexes = array();
                        try {
                            $listeComplexes = $CmbApi->ComplexesAction->GetAll();
                            $countSelect = 0;
                            foreach ($listeComplexes as $unComplexe) {
                                $countSelect++;
                                $selected = "";
                                $class = "";
                                if (isset($_GET["complexe"]) && !empty($_GET["complexe"])){
                                    $idComplexe = htmlspecialchars(trim($_GET["complexe"]));
                                    if ($idComplexe == $unComplexe->getId()){
                                        $selected = "selected";
                                        $class = "bold";
                                        $countSelect--;
                                    }
                                }
                                echo '<option '.$selected.' class="'.$class.'" value="' . $unComplexe->getId() . '" id="' . $unComplexe->getId() . '">' . $unComplexe->getNom() . '</option>';
                            }
                            if ($countSelect == count($listeComplexes))
                                echo '<option readonly selected>Choisir un complexe</option>';
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