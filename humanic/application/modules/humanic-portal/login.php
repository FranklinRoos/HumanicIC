<?php
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/onlineFunctions.php");

if(!isSet($_SESSION['blad']))
{
 $_SESSION['blad']='login_page';
}
if($_SESSION['blad']!=='login_page')    
{
  $_SESSION['blad']='login_page';
}
if (isset($_SESSION["suc6login"]) &&  isSet($_SESSION['loginnaam'])) //deze informatie komt uit functie handeleForm regel 184
{ // inloggen was succesvol
   

    unset($_SESSION["suc6login"]);
        // inloggen
    $pageNavId=2;
   /* if(isSet($_SESSION["taal"]))
    {   
        unset($_SESSION["taal"]);
    }*/
    fHeader($pageNavId);
    //navigatie($pageNavId);
    
    if($_SESSION["user_authorisatie"]=="usr")
     { 
              if($_SESSION['user-form']=='yes') //deze sessie variable wordt aangemaakt in application/modules/humanic-portal/include/humanic-functions.php
                  {           // in de functie handleForm r153
                               //als het kandidaatformulier nog niet volledig is ingevuld staat in de database in tabel 'user' de kolom 'user_activ-form' op 'no'
                         echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/userUpdate.php\"
                                     </script>";
                 }
            else 
                {
                      echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/kandidaat.php\"
                                     </script>";
                }
        navigatie($pageNavId);
        echo "<div class=\"container\">";
        echo "<h1>Je bent ingelogd!</h1><br/>";
        echo "<h4 class=\"regbericht\">Maak je keuze via de navigatieknoppen boven</h4>";
     }//de volgende session variabelen komen uit de functie handleForm(psinfoportal/include/psinfofunctions.php)
    if($_SESSION["user_authorisatie"]=="ptr")
         {
           navigatieA($pageNavId);
           echo "<div class=\"container\">";
           echo "<div id=\"welkomPieter\">Dag ".$_SESSION['loginnaam'].",je bent ingelogd als admin,wat betekent dat je o.a. blogs kan toevoegen , blogs en reacties kan verwijderen of je berichten inzien!<br/>";
           echo "De overige gebruikers-functies zijn uiteraard ook tot je beschikking.<br>";
           echo "Maak je keuze via de navigatieknoppen boven.</div>";
         }
    if($_SESSION["user_authorisatie"]=="admin")
         {
        
           echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
                                     </script>";
        
          /* navigatieA($pageNavId);
           echo "<div class=\"container\">";
           echo "<div id=\"welkomPieter\">Dag ".$_SESSION['loginnaam'].",je bent ingelogd als admin en beschikt over volledige admin functies!<br/>";
           echo "De overige gebruikers-functies zijn uiteraard ook tot je beschikking.<br>";
           echo "Maak je keuze via de navigatieknoppen boven.</div><br>";*/

         }
         //hieronder wordt bepaald hoe de datum uit de db($_SESSION['laatsgezien'])gepresenteerd zal worden
         $date = $_SESSION['laatsgezien'];//(yyyy-mm-dd)
         $datesplit = split('-',$date);
         $maanden = array('jan','feb','maart','april','mei','juni','juli','aug','sep','okt','nov','dec');
         $datum = ($datesplit[2]*1)."-".$maanden[$datesplit[1]-1]."-".$datesplit[0];//de index bij $maanden[$datesplit[1] wordt met 1 verminderd omdat de array '$maanden' met 0 begint
         
        //De naam met een hoofdletter laten beginnen bij de presentatie 
        echo "<h4 class=\"regbericht\">".ucfirst($_SESSION["loginnaam"])." ,je was hier voor het laatst op ".$datum." om ".$_SESSION['laatsgezienTijdstip']."</h4>";
         
      /* mysqli_query($connection, "INSERT INTO `online`(`user_id`) // dit was experimenteel , de tabel 'online' kan dan ook uit de database
		VALUES ('".$_SESSION["user_id"]."')")
		or die(mysqli_error());   */     
          
 }        
  else
     {
    // ** Uitloggen **
       if (isset($_GET["idinuit"]) &&  $_GET["idinuit"]==0)// uitloggen,javascript functie(config/default_functions.php regel 38 t/m 44 de parameter '0' of '1' komt van r93 of r102
         {
            uitloggen();// r485 in humanic-functions.php(of psinfofunctions)
            unset($_SESSION["loginnaam"]);
            unset($_GET["idinuit"]);
            unset($_SESSION["taal"]);//taalkeuze staat nu weer default op nederlands
            $pageNavId=2;

            fHeader($pageNavId);
            navigatie($pageNavId);
            echo "<div class=\"container\">";
            echo "<h1>Je bent uitgelogd</h1>";
            echo "<br/>";
            echo "<h3>Ik dank je voor je bezoek aan mijn website,";
            echo "<br/>";
            echo "en hoop je hier spoedig weer te mogen verwelkomen.</h3>";
            echo "<br/><br/>";
            echo "<h4>Je kunt <a href=\"login.php\">hier</a> opnieuw inloggen.</h4>";
            echo "<br/>";
            echo "</div>";
            
         } 
       else
         {
            $pageNavId=2;
            fHeader($pageNavId);
            navigatie($pageNavId);
            echo "<div class=\"container\">";
            echo "<h3>Inloggen</h3>";
            //echo "<p>";
              if (!isSet($_POST["submit"]) &&  !isSet($_SESSION['loginnaam']))// anders krijg je het login formulier weer te zien als je de brouwser vernieuwd
                 {                                                                                     // terwijl je reeds ingelogd bent
                   showForm(); //deze functie zit in humanic-portal/include/humanic-functions.php
                 }
               elseif(!isSet($_POST["submit"]) &&  isSet($_SESSION['loginnaam']))//als je reeds ingelogd bent en de brouwser verniewd, zou je anders in een loop blijven
               {
               if($_SESSION['user-form'] ==='no')
                 {
                     $sql = mysqli_query($connection, "SELECT * FROM `user` where `user_form-activ`='no' and `user_activ` ='yes'");                    
                        if (mysqli_num_rows($sql)==0)   
                            {
                                 die ("Je hebt geen gegevens tot je beschikking");
                            }

                      while ($content = mysqli_fetch_assoc($sql)) 
                          {
                                    $_SESSION["suc6login"] = "suc6login";
                                     echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/kandidaat.php\"
                                     </script>";     
                            }
                     }
                                     $_SESSION["suc6login"] = "suc6login";
                                     echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/login.php\"
                                     </script>"; 

               }
              else
                 {    
                   handleForm();
                  }
            echo "</div>";
          }
}
fFooter();
?>
