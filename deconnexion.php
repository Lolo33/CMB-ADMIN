<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 11/09/2017
 * Time: 15:15
 */

include "includes/init.php";
session_unset();
session_destroy();
header("Location: index.php");