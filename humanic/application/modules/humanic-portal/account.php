<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("include/accountFunctions.php");
include("include/humanic-functions.php");
include("../../config/default_functions.php");
//include("../../config/logo.php");// voor het dynamisch genereren van de logo

 
if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='account_page';
    }    
if(isSet($_SESSION['blad']) && $_SESSION['blad'] !=='account_page')    
{
  $_SESSION['blad']='account_page';
}
 

 $pageNavId=22;
 fHeader($pageNavId);//actief=$pageNavId);
 navigatie($pageNavId);


  
      if (!isset($_SESSION["loginnaam"]))
           {
             echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['apppath']."/index.php\"
                           </script>";         
           } 
     else    
          {  
                if(!isSet($_POST['modsubmit']))
                      {
                           showFormModifyAccount($_SESSION["loginnaam"],$_SESSION['email']);  
                      }
                else
                     {
                          handleModifyAccount ($_SESSION["loginnaam"],$_SESSION['email']);     
                     }
            
           }
fFooter($pageNavId); 
?>