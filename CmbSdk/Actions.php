<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 29/08/2017
 * Time: 15:54
 */

namespace CmbSdk;

use CmbSdk\ClassesMetiers\ClasseMetierInterface;
use CmbSdk\ClassesMetiers\Complexe;
use CmbSdk\ClassesMetiers\ComplexeGerant;
use CmbSdk\ClassesMetiers\Coordonnee;
use CmbSdk\ClassesMetiers\PlageHoraire;
use CmbSdk\ClassesMetiers\PlageHoraireStatut;
use CmbSdk\ClassesMetiers\PlanningComission;
use CmbSdk\ClassesMetiers\PlanningTarif;
use CmbSdk\ClassesMetiers\Reservation;
use CmbSdk\ClassesMetiers\Terrain;
use CmbSdk\ClassesMetiers\TerrainType;
use CmbSdk\ClassesMetiers\UtilisateurApi;
use CmbSdk\ClassesMetiers\UtilisateurToken;
use CmbSdk\Exceptions\PermissionException;
use CmbSdk\Exceptions\ReponseException;

class Actions extends Requetes
{

    protected $objet;
    protected $modeProduction = false;

    public function __construct($url, $api_key, $modeProduction)
    {
        $this->modeProduction = $modeProduction;
        parent::__construct($url,$api_key);
    }

    /// METHODES D'ACTION :: Effectuer une action sur un objet (à utiliser)
    /**
     * Envoie une requete pour récupérer une ressource par son id. Retourne le ressource souhaité sous forme d'objet.
     * @param int $id                           id de la ressource
     * @return ClasseMetierInterface            Un objet vide implémentant l'interface ClasseMetier (sert à lister les propriétés)
     * @throws PermissionException              Leve une exception si l'utilisateur n'a pas la permission d'accès a cette ressource
     */
    public function Get($id){
        $url = $this->url;
        $this->url .= "/".$id;
        $rep = $this->convertJsonToPHP($this->objet, $this->sendGetRequest());
        $this->url = $url;
        return $rep;
    }

    /**
     * Envoie une requete pour récupérer toutes les ressources et retourne un tablea d'objet hydraté
     * @return array|ClasseMetierInterface
     */
    protected function GetAll(){
        $aray_json = json_decode($this->sendGetRequest());
        $new_array_obj = array();
        if (is_array($aray_json)) {
            foreach ($aray_json as $unObjJson) {
                $rep_obj = $this->convertJsonToPHP($this->objet, json_encode($unObjJson));
                $new_array_obj[] = $rep_obj;
            }
        }else{
            $rep_obj = $this->convertJsonToPHP($this->objet, json_encode($aray_json));
            $new_array_obj[] = $rep_obj;
        }
        return $new_array_obj;
    }

    /**
     * Envoie une requete pour ajouter une ressource, et retourne un objet du type de la ressource ajoutée.
     * @param ClasseMetierInterface $obj
     * @return array|ClasseMetierInterface
     */
    protected function Creer(ClasseMetierInterface $obj){
        $content = $obj->serializeProperties();
        $reponse = $this->convertJsonToPHP($obj, $this->sendPostRequest($content));
        return $reponse;
    }

    /**
     * Envoie une requete pour supprimer une ressource, retourne true si la ressouce à bien été effacée, le code d'erreur HTTP sinon
     * @param int $id                           l'ID de la ressource à supprimer
     * @return bool|mixed                       true si la requete à bien fonctionné, 404 ou 403 sinon
     */
    protected function Supprimer($id){
        $url = $this->url;
        $this->url .= "/".$id;
        $rep = $this->sendDeleteRequest();
        $this->url = $url;
        return$rep;
    }



    /// METHODES INTERNES :: Méthodes gérant fonctionnement des méthodes d'action
    protected function convertJsonToPHP($obj, $reponse_json){
        $array_user_json = json_decode($reponse_json);
        $new_obj = $this->hydraterObjet($obj, $array_user_json);
        if (method_exists($new_obj, "truncObjetVide"))
            $new_obj->truncObjetVide();
        return $new_obj;
    }

    /**
     * Convertit un tableau d'objets / objet STD en objet ou tableau d'objets ClasseMetier du type de $unObjStd
     * @param ClasseMetierInterface $objet              objet qui va être hydraté par la fonction
     * @param ClasseMetierInterface|array $unObjStd     objet vide (défini dans le constructeur de la classe) contenant le type de la propriété (tableau ou objet)
     * @param string $setter                            nom de la méthode pour modifier une propriété (setMaPropriété / addMaPropriété)
     * @param StdClass|array() $proprieteObjet          valeurs à insérer dans le nouvel objet
     */
    protected function hydraterObjetDansObjet($objet, $unObjStd, $setter, $proprieteObjet){
        if (is_array($unObjStd)){
            if (isset($unObjStd[0]))
                $this->hydraterObjetDansObjet($objet, $unObjStd[0], $setter, $proprieteObjet);
        }elseif ($unObjStd instanceof Complexe) {
            $objet->$setter($this->hydraterObjet(new Complexe(true), $proprieteObjet));
        } elseif ($unObjStd instanceof ComplexeGerant) {
            $objet->$setter($this->hydraterObjet(new ComplexeGerant(), $proprieteObjet));
        } elseif ($unObjStd instanceof Coordonnee) {
            $objet->$setter($this->hydraterObjet(new Coordonnee(), $proprieteObjet));
        } elseif ($unObjStd instanceof PlageHoraire) {
            $objet->$setter($this->hydraterObjet(new PlageHoraire(true), $proprieteObjet));
        } elseif ($unObjStd instanceof PlageHoraireStatut) {
            $objet->$setter($this->hydraterObjet(new PlageHoraireStatut(), $proprieteObjet));
        } elseif ($unObjStd instanceof PlanningComission) {
            $objet->$setter($this->hydraterObjet(new PlanningComission(true), $proprieteObjet));
        } elseif ($unObjStd instanceof PlanningTarif) {
            $objet->$setter($this->hydraterObjet(new PlanningTarif(true), $proprieteObjet));
        } elseif ($unObjStd instanceof Reservation) {
            $objet->$setter($this->hydraterObjet(new Reservation(true), $proprieteObjet));
        } elseif ($unObjStd instanceof Terrain) {
            $objet->$setter($this->hydraterObjet(new Terrain(true), $proprieteObjet));
        } else if ($unObjStd instanceof TerrainType) {
            $objet->$setter($this->hydraterObjet(new TerrainType(true), $proprieteObjet));
        } else if ($unObjStd instanceof UtilisateurApi) {
            $objet->$setter($this->hydraterObjet(new UtilisateurApi(), $proprieteObjet));
        }else if ($unObjStd instanceof UtilisateurToken) {
            $objet->$setter($this->hydraterObjet(new UtilisateurToken(), $proprieteObjet));
        }else{
            // TODO :: Implémenter une exception ?
        }
    }

    protected function hydraterObjet(ClasseMetierInterface $objet, $array_user_json){
        $objet = clone ($objet);
        // On parcours toutes les propriétés de l'objet de base (méthode iterateProperties)
        foreach ($objet->iterateProperties()as $key => $val) {
            $getter = 'get' . ucfirst($key);
            if (method_exists($objet, $getter)) {
                if (is_array($objet->$getter())) {
                    $setter = 'add' . ucfirst($key);
                } else {
                    $setter = 'set' . ucfirst($key);
                }
                if (isset($array_user_json->$key) && method_exists($objet, $setter)) {
                    // Valeur de la propriété : peut être de type "normal" (int, string...), Objet STD, ou tableau d'objets STD
                    $valeur_a_set = $array_user_json->$key;
                    // Si la propriété de l'objet de base est un tableau
                    if (is_array($objet->$getter())) {
                        // On parcours le tableau
                        foreach ($valeur_a_set as $k => $v) {
                            // On hydrate chacun des objets du tableau de valeurs (tableau d'objets STD)
                            $this->hydraterObjetDansObjet($objet, $objet->$getter(), $setter, $v);
                        }
                        // Si la propriété de l'objet de base est un objet implémentant ClasseMetierInterface
                    } elseif ($objet->$getter() instanceof ClasseMetierInterface) {
                        // On hydrate ce nouvel objet avec les valeurs (objet STD)
                        $this->hydraterObjetDansObjet($objet, $objet->$getter(), $setter, $valeur_a_set);
                        // Sinon (c'est une propriété "normale")
                    } else {
                        // On assigne la valeur
                        $objet->$setter($valeur_a_set);
                    }
                }
            }
        }
        return $objet;
    }

}