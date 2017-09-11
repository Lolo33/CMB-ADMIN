<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 30/08/2017
 * Time: 03:07
 */

namespace CmbSdk\Exceptions;


use Throwable;

class ReponseException extends \Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->code = $code;
    }

    public function getReponse()
    {
        switch ($this->code)
        {
            case 404:
                return "Ressource introuvable";
                break;
            case 403:
                return "Ressource interdite";
                break;
            case 400:
                return "Informations invalides";
                break;
            case 500:
                return "Erreur interne.";
                break;
            default:
                return "Réponse Inconnue, consultez la méthode getMessage() de cette exception pour en savoir plus";
        }
    }

}