<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include ("../psinfoportal/include/onlineFunctions.php");

$pageNavId=50;
fHeader($pageNavId);//actief=$pageNavId);

if($_SESSION["user_authorisatie"]=="admin")
         {
           navigatieA($pageNavId);
         }
 else
     {
       navigatie($pageNavId);      
     }
 

   $sql = mysql_query("SELECT * FROM `user` where `user_online`='y'");
    if (mysql_num_rows($sql)==0)   
    {
        die ("Je hebt geen gegevens tot je beschikking");
    }
   /* while ($content = mysql_fetch_assoc($sql)) 
    {
        $userid = $row['user_id'];
        $_SESSION['user_id'] = $userid;
    }*/


  echo "<br />";
  onlineLog($sTime = 300);
  onlineShow();
  echo "<br />";
  onlineTable();

//echo "</div>";  
 fFooter($pageNavId);       
?>

