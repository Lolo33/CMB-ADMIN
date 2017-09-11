<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 05/09/2017
 * Time: 02:47
 */

include 'api_conf.php';

try {

    echo "<br /><br />";
    echo "Récupération de la liste des terrains d'un complexe : ";
    $TerrainsDuComplexe1 = $CmbApi->TerrainsAction->GetByComplexe(1);
    var_dump($TerrainsDuComplexe1);

    echo "<br /><br />";
    echo "Récupération d'un terrain : ";
    $Terrains1 = $CmbApi->TerrainsAction->Get(1);
    var_dump($Terrains1);

}catch (\CmbSdk\Exceptions\ReponseException $e){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
}