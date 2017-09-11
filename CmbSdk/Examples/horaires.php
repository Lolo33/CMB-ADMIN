<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 14:24
 */

include 'api_conf.php';

try {

    echo "Récupération de la liste des plages horaires : ";
    $horaires_terrain_1 = $CmbApi->PlageHorairesAction->GetAllFromTerrain(1);
    var_dump($horaires_terrain_1);

    echo "<br /><br />";
    echo "Récupération d'une plage horaire : ";
    $horaires_1= $CmbApi->PlageHorairesAction->Get(1);
    var_dump($horaires_1);

}catch (\CmbSdk\Exceptions\ReponseException $e){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
}