<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 30/08/2017
 * Time: 00:34
 */

namespace CmbSdk\ClassesMetiers;

/**
 * Interface ClasseMetierInterface - Désigne une classe Métier, à hydrater par la classe Actions.
 * @package CmbSdk\ClassesMetiers
 */
interface ClasseMetierInterface
{

    /**
     * Méthode qui énumère les propriétés souhaités d'un objet implémentant l'interface
     * @return mixed
     */
    public function iterateProperties();

    /**
     * Méthode qui transforme les propriétés d'un objet au format requis pour l'envoi d'une requête POST
     * @return mixed
     */
    public function serializeProperties();

}