<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 12:47
 */

namespace CmbSdk;


use CmbSdk\ClassesMetiers\PlageHoraire;

class ActionsPlagesHoraires extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new PlageHoraire(true);
    }

    public function GetAllFromTerrain($id_terrain)
    {
        $url = $this->url;
        if (!$this->modeProduction)
            $url_base = CmbApi::URL_TEST;
        else
            $url_base = CmbApi::URL_PROD;
        $this->url = $url_base . Routes::URL_TERRAINS . "/" . $id_terrain . Routes::URL_HORAIRES;
        $rep = parent::GetAll();
        $this->url = $url;
        return $rep;
    }


}