<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!--if(!isSet($_SESSION["user_authorisatie"]) OR  (isSet($_SESSION["user_authorisatie"]) && $_SESSION["user_authorisatie"] === "usr") &&  isSet($_SESSION["loginnaam"])){-->
<?php
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['apppath']."assets/css/fuikweb.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['apppath']."assets/css/style.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">";
    echo "<script src=\"https://code.jquery.com/jquery-2.2.4.min.js\"  ></script>";
    echo  "<script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>";
?>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <title></title>
    </head>
    <body>
        <header>
            <p class="objP">In dit scherm kunt U uw foto uploaden. Klik hiervoor op bladeren om uw foto
               te selecteren en daarna op Opslaan.
            </p>
  
        </header>
        <div class="container">
            <form action="http://localhost/HumanicKandidaat/humanic/application/modules/humanic-portal/verwerkFoto.php" method="post" enctype="multipart/form-data">
                <div class="objSelect" >
                    <input class="col-sm-12 btn btn-primary btn-sm " type="file" name="foto" >
                </div>
                <div class="objOpslaan">
                    <button class="col-sm-12 btn btn-primary btn-sm" type="submit" id="Fotosubmit" name="submit" >Opslaan</button>
                </div>    
                
            </form>
        </div>
    </body>
</html> 
<!--}-->
