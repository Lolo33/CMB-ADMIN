<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 15:08
 */

include 'api_conf.php';

try {

    echo "Récupération de la liste de vos comissions :";
    $com_terrain_1 = $CmbApi->PlanningComissionAction->GetAllFromTerrain(1);
    var_dump($com_terrain_1);

    echo "<br /><br />";
    echo "Récupération d'une de vos comission:";
    $com_1= $CmbApi->PlanningComissionAction->Get(1);
    var_dump($com_1);

}catch (\CmbSdk\Exceptions\ReponseException $e){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
}