<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("include/humanic-functions.php");
include("../../config/default_functions.php");

global $connection;
 $pageNavId=22;
 fHeader($pageNavId);//actief=$pageNavId);
 navigatie($pageNavId);

 $vergCode = "";
 $sql = mysqli_query($connection, "UPDATE `user` SET `vergeetcode`= '".$vergCode."' ,`vergeetstatus`= 'n' WHERE `user_inlognaam` = '".$_SESSION['naam']."'")  or die(mysqli_error());

                 if(!isSet($_POST['passwsubmit']))
                      {
                           showFormChangePassw($_SESSION['naam'], $_SESSION['email']);
                      }
                else
                      {
                           handleFormChangePassw ();     
                      }

fFooter($pageNavId); 
?>