<?php
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/formValidatie.php");


if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='kandidaat_page';
    }    
if(isSet($_SESSION['blad'])&& $_SESSION['blad'] !=='kandidaat_page')    
{
  $_SESSION['blad']='kandidaat_page';
}

if(!isSet($_SESSION['loginnaam'])) {
                    echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['apppath']."/application/modules/admin/indexAdmin.php\"
                                     </script>";
}


 $pageNavId=6;
 fHeader($pageNavId);//actief=$pageNavId);
 navigatie($pageNavId);
 
/* if(!isSet($_SESSION['user_authorisatie']) OR $_SESSION['user_authorisatie']=='usr')
 {
     navigatie($pageNavId);
 }*/
 

global $connection;
$functieArray = array();
$sql = mysqli_query($connection, "SELECT * FROM user_functie WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['functie_id'], $row['ervaring'], $row['nwFunctie']);
            array_push($functieArray, $newArray);
        }
    }
    else {
        echo "kandiaat 48 fout";
    };
    
$gewensteSectorArray = array();   
    $sql = mysqli_query($connection, "SELECT * FROM gewenste_sector WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['sector_id']);
            array_push($gewensteSectorArray, $newArray);
        }
    }
    else {
        echo "kadidaat 60 fout";
    };    
    
//vullen sectorArray    
$sectorArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_sector WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['sector_id'], $row['jaren']);
            array_push($sectorArray, $newArray);
        }
    }
    else {
        echo "kandiaat 73 fout";
    };
    
//vullen bedrijfGewerkt Array
$bedrijfGewerktArray = array();
$sql = mysqli_query($connection, "SELECT * FROM bedrijf_gewerkt WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['bedrijf_id']);
            array_push($bedrijfGewerktArray, $newArray);
        }
    }
    else {
        echo "kandiaat 86 fout";
    };    
        
//vullen bedrijf Array    
$bedrijfArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_bedrijf WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['bedrijf_id']);
            array_push($bedrijfArray, $newArray);
        }
    }
    else {
        echo "kandidaat 99 fout";
    };
// vullen regio array    
$regioArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_regio WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['regio_id']);
            array_push($regioArray, $newArray);
        }
    }
    else {
        echo "kandiaat 111 fout";
    };

if(!isSet($_POST['submit']))
{
    /* ****Important!****
    replace name@your-web-site.com below 
    with an email address that belongs to 
    the website where the script is uploaded.
    For example, if you are uploading this script to
    www.my-web-site.com, then an email like
    form@my-web-site.com is good.
    */

// vullen functie array
    
    

    showKandidaatRegForm (); // deze functie komt in humanic-portal/include/humanic-functions.php
    
}
 else 
 {
   handleKandidaatRegForm (); // deze functie komt in humanic-portal/include/humanic-functions.php
}
	
//}
fFooter($pageNavId);
?>


     

     