<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 12:31
 */

namespace CmbSdk;


use CmbSdk\ClassesMetiers\ClasseMetierInterface;
use CmbSdk\ClassesMetiers\UtilisateurApi;

class ActionsUtilisateurs extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new UtilisateurApi();
    }

    public function Creer(ClasseMetierInterface $obj)
    {
        return parent::Creer($obj);
    }


}