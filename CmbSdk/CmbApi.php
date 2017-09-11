<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 29/08/2017
 * Time: 15:17
 */

namespace CmbSdk;

use CmbSdk\ClassesMetiers\Complexe;
use CmbSdk\ClassesMetiers\PlageHoraire;
use CmbSdk\ClassesMetiers\Terrain;
use CmbSdk\ClassesMetiers\UtilisateurApi;
use CmbSdk\ClassesMetiers\UtilisateurToken;

class CmbApi extends Requetes
{

    public $UtilisateursAction;
    public $TokensAction;
    public $ComplexesAction;
    public $PlageHorairesAction;
    public $TerrainsAction;
    public $PlanningTarifsAction;
    public $PlanningComissionAction;
    public $ReservationsAction;

    private $modeProduction = false;

    const URL_PROD = "http://api.connectmybooking.com";
    const URL_TEST = "http://test.api.connectmybooking.com";

    public function __construct($api_key)
    {
        if ($this->modeProduction === true)
            $url = CmbApi::URL_PROD;
        else
            $url = CmbApi::URL_TEST;
        parent::__construct($url, $api_key);
        $this->UtilisateursAction = new ActionsUtilisateurs($url . Routes::URL_USER, $api_key, $this->modeProduction);
        $this->TokensAction = new ActionsTokens(Routes::URL_TOKEN, $api_key, $this->modeProduction);
        $this->ComplexesAction = new ActionsComplexes($url . Routes::URL_COMPLEXES , $api_key, $this->modeProduction);
        $this->TerrainsAction = new ActionsTerrains($url . Routes::URL_TERRAINS, $api_key, $this->modeProduction);
        $this->PlageHorairesAction = new ActionsPlagesHoraires($url . Routes::URL_HORAIRES, $api_key, $this->modeProduction);
        $this->PlanningTarifsAction = new ActionsPlanningTarifs($url . Routes::URL_TARIFS, $api_key, $this->modeProduction);
        $this->PlanningComissionAction = new ActionsPlanningComissions($url . Routes::URL_COMISSION, $api_key, $this->modeProduction);
        $this->ReservationsAction = new ActionsReservations($url . Routes::URL_RESERVATION, $api_key, $this->modeProduction);
    }

    public function DeterminerTarifReservation(PlageHoraire $plageHoraire)
    {
        $tarifs = $this->PlanningTarifsAction->GetAllFromTerrain($plageHoraire->getTerrain()->getId());
        foreach ($tarifs as $unTarif) {
            // Récupération des infos de la plage horaire au bon format
            $plage_debut = new \DateTime($plageHoraire->getHeureDebut());
            $plage_fin = new \DateTime($plageHoraire->getHeureFin());
            $jour_plage = $plage_debut->format("w");
            // Récupération des infos du tarif au bon format
            $jour_tarif = $unTarif->getJourDeLaSemaine();
            $heure_debut_tarif = new \DateTime($unTarif->getHeureDebut());
            $heure_fin_tarif = new \DateTime($unTarif->getHeureFin());
            // Met toutes les dates à 0 pour ne comparer que l'heure
            $heure_debut_tarif->setDate(0,0,0);
            $plage_debut->setDate(0, 0, 0);
            $plage_fin->setDate(0,0,0);
            $heure_fin_tarif->setDate(0,0,0);
            /// Test si cest le jour du tarif correspond à celui de la plage horaire
            if ($jour_tarif == $jour_plage) {
                // Si l'heure de début et fin du tarif est contenue entièrement dans la plage horaire
                if ($heure_debut_tarif <= $plage_debut && $heure_fin_tarif >= $plage_fin) {
                    $nb_heures_jeu = $plage_fin->diff($plage_debut)->h;
                    return $unTarif->getMontant() * $nb_heures_jeu;
                }elseif ($plage_debut < $heure_debut_tarif && $plage_fin <= $heure_fin_tarif){
                    $prix_plage_1 = $plage_fin->diff($heure_debut_tarif)->h;
                    foreach ($tarifs as $unTarife){
                        $tarif_debut = new \DateTime($unTarife->getHeureDebut());
                        $jour_tarif_2 = $unTarife->getJourDeLaSemaine();
                        if ($jour_tarif_2 == $jour_plage) {
                            if ($tarif_debut <= $plage_debut){
                                $prix_plage_2 = $plage_debut->diff($heure_debut_tarif)->h;
                                return $prix_plage_2 + $prix_plage_1;
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    /**
     * @return bool
     */
    public function isModeProduction()
    {
        return $this->modeProduction;
    }
    /**
     * @param bool $modeProduction
     */
    public function setModeProduction($modeProduction)
    {
        $this->modeProduction = $modeProduction;
    }

}

