<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("include/accountFunctions.php");
include("include/humanic-functions.php");
//include ("include/onlineFunctions.php");
include("../../config/default_functions.php");
//include ("../FCKeditor/fckeditor.php");

 $pageNavId=22;
 fHeader($pageNavId);//actief=$pageNavId);
 navigatie($pageNavId);

  
      if (!isset($_SESSION["loginnaam"]))
           {
             echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['path']."/index.php\"
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