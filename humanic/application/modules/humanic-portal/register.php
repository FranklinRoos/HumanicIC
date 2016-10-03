<?php
session_start();
//09-07-2015
//F.Roos
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
//include("../../config/logo.php");
include("include/humanic-functions.php");


if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='register_page';
    }    
if(isSet($_SESSION['blad']) && $_SESSION['blad'] !=='register_page')    
{
  $_SESSION['blad']='register_page';
}


$pageNavId=6;
fHeader($pageNavId);
navigatie($active=$pageNavId);


if(isSet($_SESSION['loginnaam'])) 
{
     //$_SESSION["suc6login"] = "suc6login";
                                     echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['apppath']."/application/modules/humanic-portal/kandidaat.php\"
                                     </script>"; 
}


if (!isSet($_POST["regsubmit"]))
{    
    showAanmeldForm();
    fFooter($active=$pageNavId);
} 
else
{    
    handleAanmeldForm();
    
}
echo "</div>";

?>
