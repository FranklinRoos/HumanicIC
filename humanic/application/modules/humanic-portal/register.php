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

// haal je gegevens voor de pagina uit database

$sql = mysql_query("SELECT * FROM `pages` where `page_nav_id`='2' and `page_show` ='y'");
if (mysql_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
echo "<div class=\"container\">";

while ($content = mysql_fetch_assoc($sql)) 
{
    echo $content["page_title"];
    
    //echo "<h3>Registration Form</h3>";
    
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