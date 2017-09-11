<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 14:21
 */

namespace CmbSdk;


use CmbSdk\ClassesMetiers\PlanningTarif;

class ActionsPlanningTarifs extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new PlanningTarif(true);
    }

    public function GetAllFromTerrain($id_terrain)
    {
        $url_base = $this->url;
        if ($this->modeProduction === true)
            $url = CmbApi::URL_PROD;
        else
            $url = CmbApi::URL_TEST;
        $this->url = $url . Routes::URL_TERRAINS . "/" . $id_terrain . Routes::URL_TARIFS;
        $rep = parent::GetAll();
        $this->url = $url_base;
        return $rep;
    }

}