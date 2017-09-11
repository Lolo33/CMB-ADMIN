<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 08/09/2017
 * Time: 02:43
 */

include 'api_conf.php';

/***
 *      ********** OPERATIONS SUR LES RESERVATIONS **********
 */

try {
    echo "Création de la reservation: ";
    $Reservation = new \CmbSdk\ClassesMetiers\Reservation();
    // plage horaire sur laquelle réserver
    $Horaire = $CmbApi->PlageHorairesAction->Get(23);
    // Attribution des valeurs de la réservation
    $Reservation->setPlageHoraire($Horaire);
    $Reservation->setNomClient("Mickael Lambda");
    $Reservation->setTelephoneClient("0654789858");
    // Ajout de la réservation
    $resa = $CmbApi->ReservationsAction->Creer($Reservation);
    $id = $resa->getId();
    $nouvelle_plage_horaire = $resa->getPlageHoraire();
    var_dump($resa);

    echo '<br /><br />';
    echo "Récupération de cette réservation : ";
    $Resa = $CmbApi->ReservationsAction->Get($id);
    var_dump($Resa);

    echo '<br /><br />';
    echo "Récupération de toutes vos réservations: ";
    $Resas = $CmbApi->ReservationsAction->GetAll();
    var_dump($Resas);

    echo '<br /><br />';
    echo "Suppression de la réservation : ";
    $Delete_resa = $CmbApi->ReservationsAction->Supprimer($id);
    if ($Delete_resa)
        echo "<br />Réservation supprimée";

}catch (\CmbSdk\Exceptions\ReponseException $e){
    echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
        "Message : " . $e->getMessage();
}



