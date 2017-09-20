<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 14:53
 */

namespace CmbSdk;


use CmbSdk\ClassesMetiers\PlanningComission;

class ActionsPlanningComissions extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new PlanningComission(true);
    }

    public function GetAllFromTerrain($id_terrain)
    {
        $url = $this->url;
        if ($this->modeProduction === true)
            $url_base = CmbApi::URL_PROD;
        elseif ($this->modeProduction === false)
            $url_base = CmbApi::URL_TEST;
        else
            $url_base = CmbApi::URL_LOCAL;
        $this->url = $url_base . Routes::URL_TERRAINS . "/" . $id_terrain . Routes::URL_COMISSION;
        $rep = parent::GetAll();
        $this->url = $url;
        return $rep;
    }

}