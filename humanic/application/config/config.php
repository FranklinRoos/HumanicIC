<?php
/*
 * file: config.php
 * Bevat centrale variabelen.
 */

$host ="localhost";
$database = "kandidaten";
$user= "admin";
$pass= "123";

$urlpath     = "http://".$_SERVER['HTTP_HOST'].":7777/HumanicIC/"; // de basis URL naar de applicatie.
$apppath     = "/HumanicIC/humanic/";          // de root binnen de applicatie.

$modulespath = $GLOBALS['apppath']."application/modules/";
$jspath      = $GLOBALS['apppath']."assets/js/";
$csspath     = $GLOBALS['apppath']."assets/css/";
$imagepath   = $GLOBALS['apppath']."assets/images/";
$cvpath      = $GLOBALS['apppath']."assets/cv/";
$moviepath   = $GLOBALS['apppath']."assets/movies/";

?>
