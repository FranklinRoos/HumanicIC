<?php
/*
 * file: config.php
 * Bevat centrale variabelen.
 */

$host ="localhost";
$database = "kandidaten";
$user= "admin";
$pass= "123";

// de basis URL naar de applicatie. Wordt vooralsnog niet gebruikt.
// Alleen van belang waar een externe referentie naar de site moet worden gegeven.
$urlpath     = "http://".$_SERVER['HTTP_HOST']."/humanic/";

$apppath     = "/humanic/";          // de root binnen de applicatie.
$csspath     = $GLOBALS['apppath']."assets/css/";
$cvpath      = $GLOBALS['apppath']."assets/cv/";
$imagepath   = $GLOBALS['apppath']."assets/images/";
$jspath      = $GLOBALS['apppath']."assets/js/";
$modulespath = $GLOBALS['apppath']."application/modules/";
$moviepath   = $GLOBALS['apppath']."assets/movies/";

?>
