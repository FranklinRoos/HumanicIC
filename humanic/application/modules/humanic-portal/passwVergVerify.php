<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
//include("include/accountFunctions.php");
include("include/humanic-functions.php");
include("../../config/default_functions.php");
//include ("../FCKeditor/fckeditor.php");

global $connection;
 $pageNavId=22;
 fHeader($pageNavId);//actief=$pageNavId);
 navigatie($pageNavId);

 $_SESSION['code'] =  $_GET['acode'];
 $sql = mysqli_query($connection, "SELECT * FROM `user` WHERE `vergeetcode`= '".$_SESSION['code']."' AND `vergeetstatus`= 'y'");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
         {            
                 $_SESSION['naam'] = $row['user_inlognaam'];       
                 $_SESSION['email'] = $row['user_email'];

                 echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['apppath']."/application/modules/humanic-portal/passwVerg.php\"
                                </script>";  
                      
         }  
fFooter($pageNavId); 
?>