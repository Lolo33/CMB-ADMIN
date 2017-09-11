<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 18:05
 */

namespace CmbSdk;


use CmbSdk\ClassesMetiers\ClasseMetierInterface;
use CmbSdk\ClassesMetiers\Reservation;

class ActionsReservations extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new Reservation(true);
    }

    public function Creer(ClasseMetierInterface $obj)
    {
        return parent::Creer($obj);
    }

    public function GetAll()
    {
        return parent::GetAll();
    }

    public function Supprimer($id)
    {
        return parent::Supprimer($id);
    }

}