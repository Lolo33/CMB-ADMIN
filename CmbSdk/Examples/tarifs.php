<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 14:54
 */

include 'api_conf.php';

try {

    echo "<br /><br />";
    echo "Récupération de la liste des tarifs d'un terrain";
    $tarifs_terrain_1 = $CmbApi->PlanningTarifsAction->GetAllFromTerrain(1);
    var_dump($tarifs_terrain_1);

    echo "<br /><br />";
    echo "Récupération d'un tarif";
    $tarifs_1 = $CmbApi->PlanningTarifsAction->Get(1);
    var_dump($tarifs_1);

}catch (\CmbSdk\Exceptions\ReponseException $e){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
}