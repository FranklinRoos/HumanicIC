<?php
session_start(); // in de database wordt naar dit script(indexAdmin.php) verwezen vanuit de nav-tabel met nav_id=8
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include("../humanic-portal/include/humanic-functions.php");
//fHeader();
$pageNavId=1;
fHeader($pageNavId);//actief=$pageNavId);
navigatie($pageNavId);

/*if($_SESSION['blad']!=='admin_page')    
{
  //unset ($_SESSION['blad']);
  $_SESSION['blad']='admin_page';
}*/


echo"<div class=\"container\">";
echo "<div class=\"container\" style=\"margin-top:40px;\">";

if(isset($_SESSION['loginnaam']))
  { 
    
    if($_SESSION["user_authorisatie"]=='admin')
    { 
        echo "<h2>U heeft niet de juiste rechten</h2>";
        uitloggen();
        unset($_GET["idinuit"]);
        //navigatie();
        fFooter();                                // ALLE NAVIGATIE FUNCTIES BEVINDEN ZICH IN: application/config/default_functions.php
    }

  }   
 elseif(!isset($_SESSION['loginnaam'])) 
     {
     
     echo "<br /><div class=\"bericht\"><h2 align=center>Dit is de website van HumanicIC</h2>";
    echo "<br /><h3>U heeft niet de juiste rechten of bent nog niet <a href=\"../humanic-portal/login.php\"> ingelogd</a> te zijn</h3></div>";
    fFooter();
     
    }


echo "</div>";   

footer();

?>
