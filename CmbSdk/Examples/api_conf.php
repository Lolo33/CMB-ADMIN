<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 31/08/2017
 * Time: 02:12
 */

use CmbSdk\Autoloader;
use CmbSdk\CmbApi;

include "../Autoloader.php";

Autoloader::register();

$CmbApi = new CmbApi( "ZwbyKi5TGaXT5q9tflMO73iXxHyrE0XNuZJiRC61pmW49rCA3WeAfqx9NpilI2jx6iw=");
//$CmbApi->setModeProduction(true);