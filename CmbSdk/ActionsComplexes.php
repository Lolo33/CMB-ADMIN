<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 12:00
 */

namespace CmbSdk;

use CmbSdk\ClassesMetiers\ClasseMetierInterface;
use CmbSdk\ClassesMetiers\Complexe;

class ActionsComplexes extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new Complexe(true);
    }

    public function GetAll()
    {
        return parent::GetAll();
    }

}