<?php
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/formValidatie.php");
    global $connection;
    $uploadOk = 1;
    
    $target_dir = "C:/xampp/htdocs/HumanicKandidaat/humanic/assets/images/";
    $img_id = uniqid();

    $target_file = $target_dir .basename($_FILES["foto"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    //$cvFileType = pathinfo($_SESSION['cv'], PATHINFO_EXTENSION);
    $extensionPos = strripos($_SESSION['foto'], ".");
    
    
    $strLen = strlen($_SESSION['foto']);
    $fotoFileType = substr($_SESSION['foto'], $extensionPos + 1, $strLen);
    
    // Check if file already exists
    if ($_SESSION['foto'] != "") {
        //controle file type, niet gelijk dan file type vervangen
        if ($imageFileType != $fotoFileType){
            $_FILES["foto"]["name"] = substr_replace($_SESSION['foto'],$imageFileType, $extensionPos + 1);
        }
        else {
            $_FILES["foto"]["name"] = $_SESSION['foto'];
        }
        $target_file = $target_dir .basename($_FILES["foto"]["name"]);
    }
    else {
        $_FILES["foto"]["name"] = $img_id . "." . $imageFileType;
        $target_file = $target_dir .basename($_FILES["foto"]["name"]);
    }   


// Check file size
    if ($_FILES["foto"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {

            $_SESSION['foto'] = basename($_FILES["foto"]["name"]);
            $sql = mysqli_query($connection, "UPDATE `user` SET `foto` = '".$_SESSION['foto']."'
                                                WHERE `user_id` = '".$_SESSION['user_id']."'");
            if (mysqli_affected_rows($connection) == -1){
              echo mysqli_error($connection);
            }
            echo "uw CV is opgeslagen, u kunt het venster sluiten";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } 
    
    //showKandidaatRegForm();
    
 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
