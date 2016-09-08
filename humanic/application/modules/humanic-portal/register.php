<?php
session_start();
//09-07-2015
//F.Roos
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
$pageNavId=6;
fHeader($active=$pageNavId);
navigatie($active=$pageNavId);


if(isSet($_SESSION['loginnaam'])) 
{
     //$_SESSION["suc6login"] = "suc6login";
                                     echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/kandidaat.php\"
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
