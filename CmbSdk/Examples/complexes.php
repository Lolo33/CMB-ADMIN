<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 18:04
 */

include "api_conf.php";

try {

    echo "Liste des complexes partenaires :";
    $listeComplexes = $CmbApi->ComplexesAction->GetAll();
    var_dump($listeComplexes);

    echo "<br /><br />";
    echo "Affichage d'un complexe :";
    $Complexe = $CmbApi->ComplexesAction->Get(1);
    var_dump($Complexe);

}catch (\CmbSdk\Exceptions\ReponseException $e){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
}