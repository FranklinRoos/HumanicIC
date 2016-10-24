<?php
session_start();
include("application/config/config.php");
include("application/config/connect.php");
include("application/config/default_functions.php");
//include("application/config/logo.php");// voor het dynamisch genereren van de logo

if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='index_page';
    }    
if(isSet($_SESSION['blad']) && $_SESSION['blad'] !=='index_page')    
{
  $_SESSION['blad']='index_page';
}


$pageNavId=1;
fHeader($pageNavId);
navigatie($active=$pageNavId); 

/*if(!isSet($_SESSION["user_authorisatie"]) OR  (isSet($_SESSION["user_authorisatie"]) && $_SESSION["user_authorisatie"] === "usr") &&  isSet($_SESSION["loginnaam"]))
{      
    navigatie($pageNavId);    
}*/
if(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"] != "usr")
{
     echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['apppath']."/application/modules/admin/indexAdmin.php\"
            </script>";
}
$sql = mysqli_query($connection,"SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId  and `page_taal` = 'nl' and `page_show` ='y' ");
if (mysqli_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
while ($content = mysqli_fetch_assoc($sql)) 
{
    echo utf8_encode($content["page_title"]);
    echo utf8_encode($content["page_content"]);
}

fFooter($pageNavId);
?>
