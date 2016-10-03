<?php
session_start();
//13-09-2016
//F.Roos
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");

if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='nwPasw_page';
    }    
if(isSet($_SESSION['blad']) && $_SESSION['blad'] !=='nwPasw_page')    
{
  $_SESSION['blad']='nwPasw_page';
}


$pageNavId= 22;
 fHeader($pageNavId);
navigatie($active=$pageNavId);

// haal je gegevens voor de pagina uit database

$sql = mysqli_query($connection, "SELECT * FROM `pages` where `page_nav_id`='1' and `page_show` ='y'");
if (mysqli_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
echo "<div class=\"container\">";

while ($content = mysqli_fetch_assoc($sql)) 
{
    echo $content["page_title"];
    
    //echo "<h3>Registration Form</h3>";
    
}
if (!isSet($_POST["submit"]) OR (isSet($_POST["submit"]) && $_POST['email'] == ""))
{    
    showPaswVergForm();
    fFooter($active=$pageNavId);
} 
else
{    
    handlePaswVergForm($_POST['email']);
    fFooter($active=$pageNavId);
}
echo "</div>";

?>