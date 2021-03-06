<?php

global $connection;
// Begin toevoeging m.b.t.  vergeten wachtwoord
function showPaswVergForm($email="")// aanvraag het (vergeten)wachtwoord opnieuw in te stellen.
    {
        echo "<h4 class=\"aanvraag\">Aanvraag wachtwoord opnieuw in te stellen</h4>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table>";
        echo "<tr><td>We hebben uw email-adres nodig om uw wachtwoord opnieuw in te stellen:</td>";
        echo "<td><input type='email' name='email' value=$email></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='submit' value='aanvraag versturen'>";
        echo "</form><br/>";

    }


function handlePaswVergForm($email) // afhandeling van de aanvraag om het (vergeten)wachtwoord opnieuw in te stellen
{
    $_SESSION['email'] = $email;
    global $connection;
    if(getUseremail($email)=== true) // het email-adres komt voor in de database
       {
              $loginnaam = getUserLoginnaam($_SESSION['email']);
              $_SESSION['naam'] = $loginnaam;
              $vergCode=uniqid(); // deze moet je zelf ook hebben om op te kunnen controleren later 
              $_SESSION['vergCode'] = $vergCode;                  

                 $sql = mysqli_query($connection, "UPDATE  `user` SET `vergeetcode`= '".$vergCode."'  WHERE `user_email`= '".$email."'");
                    if (mysqli_affected_rows($connection)==0)
                      {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                      } 
                    else
                      {
                                   $sql = mysqli_query($connection, "UPDATE  `user` SET `vergeetstatus`= 'y'  WHERE `user_email`= '".$email."'")  or die(mysqli_error());
                                   passwVergetenLinkVerzenden ($_SESSION['naam'], $_SESSION['email'], $_SESSION['vergCode']);
                                   echo "<h4 class=\"regdata\">";
                                   echo "Er is een email verzonden naar ".$_SESSION['email']." met een activatie link,<br>";
                                   echo "u kunt uw wachtwoord opnieuw instellen  nadat u hierop heeft geklikt.";
                                   echo "</h4>";
                      }  
         }
}
 
function showFormChangePassw ($naam, $email )// formulier om het wachtwoord te veranderen
  {
     echo "<section id=\"loginblok\">";
        //echo "<h1>Modificeren wachtwoord</h1>";
             echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
                       echo "<table>";
                                echo "<tr><td>Uw login naam:</td>";
                                               echo "<td>".ucfirst($naam)."</td></tr>";
                                echo "<tr><td>E-mailadres: </td>";
                                               echo "<td>".$email."</td></tr>";
                                echo "<tr><td>&nbsp</td></tr>";
                                echo "<tr><td>&nbsp</td></tr>";
                                echo "<tr><td>Typ uw nieuw wachtwoord:</td>";
                                               echo "<td><input type='password' name='modpasswd1'</td></tr>";
                                echo "<tr><td>&nbsp</td></tr>";
                                echo "<tr><td>Herhaal uw wachtwoord:</td>";
                                               echo "<td><input type='password' name='modpasswd2'></td></tr>";
                       echo "</table>";
                       echo "<input type='submit' name='passwsubmit' value='veranderen'>";
             echo "</form>";
     echo "</section>"; 
      
 }
 
function handleFormChangePassw ()
 {
    global  $connection;
            
    if(md5(trim($_POST['modpasswd1']))==md5(trim($_POST['modpasswd2'])))
    {
        $vergeetcode = "";
        $sql = mysqli_query($connection, "UPDATE `user` SET `user_wachtwoord`='".md5(trim($_POST['modpasswd1']))."', `vergeetcode`= '".$vergeetcode."', `vergeetstatus`= 'n' WHERE `user_inlognaam`= '".$_SESSION['naam']."'");
        echo "<div class=\"berichtAcc\">".ucfirst($_SESSION["naam"]).",je wachtwoord is gewijzigd<br>";    
                       echo "Je zal opnieuw moeten inloggen om verder te gaan !";
        echo "</div>";
            // Unset all of the session variables.
             $_SESSION = array();
             session_destroy();
    }
    else
     {
       echo "<div class=\"berichtAcc\">Je moet wel 2x hetzelfde wachtwoord invullen</div>";
        showFormChangePassw ($naam,$email);
      }
}  
  
      
function passwVergetenLinkVerzenden ($loginnaam, $email, $vergCode)
{
  /* server versie http://triplers.nl/humanic/application/modules/humanic-portal/verify.php?acode=$vergCode    */
   $_SESSION['naam'] = $loginnaam;
   $_SESSION['email'] = $email; 
  $subject = 'Uw wachtwoord opnieuw instellen';
  $emailinhoud = "Uw Loginnaam: ".$loginnaam."
  Klik op deze link: http://localhost:7777/HumanicIC/humanic/application/modules/humanic-portal/passwVergVerify.php?acode=$vergCode ,om uw wachtwoord opnieuw in te stellen";
  $to = $email;
  $from = 'humanic_info@outlook.com';

  ini_set('sendmail_from', $from);

  $headers   = array();
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/plain; charset=iso-8859-1";
  $headers[] = "From: HumanIC <{$from}>";
  $headers[] = "Reply-To: HumanIC <{$from}>";
  //$headers[] = "Subject: {$subject}";
  $headers[] = "X-Mailer: PHP/".phpversion();

  mail($to, $subject, $emailinhoud, implode("\r\n", $headers) ); 
      
}

function getUserLoginnaam($email) 
 {
    global $connection;
    $email = $_SESSION['email'];
      $sql = mysqli_query($connection, "SELECT * FROM `user`");
      if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {    
            if($row['user_email'] == $email)
               {
                 $loginnaam = $row['user_inlognaam'];
               }
        }
      return $loginnaam;
 }  

//Einde toevoeging m.b.t vergeten wachtwoord



function showForm($naam= "", $passwd="")
    {
        echo "<section id=\"loginblok\">";
         echo "<h3>Inloggen</h3>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table id=\"login\">";
        echo "<tr><td>Geef uw login naam:</td>";
        echo "<td><input type='text' name='login' value= $naam></td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr id=\"loginnaam\" ><td>Geef uw wachtwoord:</td>";       
        echo "<td><input type='password' name='passwd' value=$passwd><br>";
        echo "<a href=\"nwPasw.php\">wachtwoord vergeten ?</a></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='submit' value='Login'>";
        echo "</form><br/>";
        echo "<div class=\"reg\">";
             echo "Heeft u zich nog niet geregistreerd?<br/>";
            echo "Dat kan <a href=\"register.php\"><mark>hier.</mark></a><br/><br/>";
        echo "</div>";
        echo "</section>";
    }


function handleForm()
    {
        global $connection;
        global $pageNavId;
        if (!isset($_SESSION["tellerInloggen"]))
        {
            $_SESSION["tellerInloggen"]=0;
        }
       /* if (!isSet($_COOKIE['laatsteKeer']))//als de cookoie niet bestaat,wordt die nu gemaakt
        {
            $m_int=date("n")-1;
            $m_name=array("januari","februari","maart","april","mei","juni","juli","augustus","september","oktober","november","december");
            $month=$m_name[$m_int];
            $datum=date("d ").$month.date(" Y")." om ".date("H:i")." uur";
            $_COOKIE['laatsteKeer']= $datum;
        }*/
		
		$_SESSION['passwd'] = $_POST['passwd'];
        $_SESSION['naam'] = $_POST['login'];
        if ($_POST['login']!="")
        {   // vraag het correcte login op
           if ($_POST['passwd']!="")
            {   // vraag het correcte wachtwoord en de authorisatie op 
                
           $auth = getAuthorisatie(strtolower($_POST['login']));//de auhtorisatie wordt hier opgevraagd
           $_SESSION["user_authorisatie"] = $auth;
             if($auth == 'admin')
                    {
                        echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['apppath']."/application/modules/admin/indexAdmin.php\"
                                </script>";                                  
                    }
             else
              {     
                $correct_passwd = trim(getPassword($_POST['login']));//hier wordt het ww behorende bij de loginnaam opgevraagd
                if (md5(trim($_POST['passwd']))==trim($correct_passwd))//hier wordt het ww behorende bij de loginnaam vergeleken met het opgegeven ww
                  {
                      
                       $sql2 = mysqli_query($connection,"SELECT * FROM `user` WHERE `user_inlognaam`='".$_POST["login"]."' AND `user_activ`='yes'");
                      
                        if (mysqli_num_rows($sql2)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysqli_fetch_assoc($sql2))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                         {
                             $userid = $row['user_id'];
                             $_SESSION["user_id"] = $userid;
                             $_SESSION['user-form'] = $row['user_form-activ'];
                             $_SESSION['passwd'] = md5(trim($_POST['passwd']));
                             $_SESSION['email'] = $row['user_email'];
			     date_default_timezone_set("Europe/Amsterdam");
                             $_SESSION['user_sinds'] = $row['user_sinds'];
                             $_SESSION['current_date'] = date("y-m-d");
                             $_SESSION['current_tijdstip'] = date("H:i:s");
                             if(!isSet($row['datum_gezien']))//dus als het aacount de eerste keer na registratie en activataie gebruikt word,
                               {
                                 $laatsgezien = $_SESSION['current_date']; // krijgt $laatsgezien de huidige datum(current_date)                           
                               }
                             else 
                                 {
                                   $laatsgezien = $row['datum_gezien'];//anders de opgeslagen datum uit de db
                                 }
                            if(!isSet($row['tijdstip_gezien']))//dus als het account de eerste keer na registratie en activatie gebruikt word,
                               {
                                 $laatsgezienTijdstip = $_SESSION['current_tijdstip'];//krijgt laatsgezienTijdstip het huidige tijdstip(current_tijdstip) 
                               }
                            else 
                                {
                                  $laatsgezienTijdstip = $row['tijdstip_gezien'];//en anders het opgeslagen tijdstip uit de db
                                }
                             //Informatie uit de user tabel
                             maakSessieVariabelen();
                             $_SESSION['laatsgezien'] = $laatsgezien;
                             $_SESSION['laatsgezienTijdstip'] = $laatsgezienTijdstip;
                           
                             $_SESSION['onlineIP'] = $_SERVER['REMOTE_ADDR'];                             
                             /*$_SESSION["user_authorisatie"] = $auth;*/
                             $_SESSION["loginnaam"] = $_POST["login"];
                             //$_SESSION["password"] = md5(trim($_POST["passwd"]));
                             $_SESSION["suc6login"] = "suc6login";
                             //De kolommen 'datum_gezien' , 'tijdstip_gezien' en 'user_online' van de ingelogde user worden bijgewerkt
                               $sql3 = mysqli_query($connection, "UPDATE `user` SET
		                         `user_online` = 'y', `datum_gezien` = '".$_SESSION['current_date']."', `tijdstip_gezien`= '".$_SESSION['current_tijdstip']."'                      
		                         WHERE `user_id` = '".$_SESSION["user_id"]."'")
		                         or die(mysqli_error());
                                      $useronline = $row['user_online'];
                                      $_SESSION['useronline'] = $useronline;
                             
            
                             //onlineLog();//Met deze functie(in application/modules/psinfoportal/include/onlineFunctions.php) 
                                           //de tabel 'online' in de database updaten
                             
                           //Terug naar het logon.php script  
                          echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['apppath']."/application/modules/humanic-portal/login.php\"
                           </script>";  
              
                        $sql = mysqli_query($connection, "SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId and `page_show` ='y'");
                        echo "<div class=\"container\">";
                       if (mysqli_num_rows($sql)==0)   
                          {
                            die ("Je hebt geen gegevens tot je beschikking");
                           }
                           while ($content = mysqlì_fetch_assoc($sql)) 
                             {
                               echo "<h1>".$content["page_title"]."</h1>";
                               echo "<br /><p>";
                               echo utf8_encode($content["page_content"]);
                               echo "<br /><p>";
                              }
                        echo "</div>";
                      }
                      //session_unset();;
                                    
                }  
                 else
                 {
					 echo "<div class=\"berichtAcc\">";
                    echo "Het systeem kon u niet inloggen, probeer het nogmaals!</div><br>";
                    $_SESSION["tellerInloggen"]++;
                    if ($_SESSION["tellerInloggen"]<4)
                    {
                    showForm($_SESSION['naam'], $_SESSION['passwd']);
                    }
                    else 
                    {
					  echo "<div class=\"berichtAcc\">";
                      echo "Volgens geruchten mag u maar 3 keer inloggen!</div><br>";
                    }
                 }
               }
            }
             else
               { 
				  echo "<div class=\"berichtAcc\">";
				  echo "U moet wel een wachtwoord opgeven!</div><br>";
                  showForm($_SESSION['naam'], $_SESSION['passwd']);
               } 
        }   
         else
            {  
				if($_POST['passwd'] != "")
                {   
                    echo "<div class=\"berichtAcc\">";
                    echo "U moet wel een naam opgeven!</div><br>";
                    showForm($_SESSION['naam'], $_SESSION['passwd']);
                 }
                 else
                 {
                     echo "<div class=\"berichtAcc\">";
                     echo "U moet wel een naam en een wachtwoord invullen!</div><br>";
                     showForm($_SESSION['naam'], $_SESSION['passwd']);
                  }
            } 
    }
  
function maakSessieVariabelen() 
{
        global $connection;
        $user_id = $_SESSION['user_id'];
                     // Eerst gegevens uit de USER-Tabel halen 
                         $sql4 = mysqli_query($connection, "SELECT * FROM `user` WHERE `user_id`='".$_SESSION["user_id"]."' AND `user_activ`='yes'");
                      
                        if (mysqli_num_rows($sql4)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysqli_fetch_assoc($sql4))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                         {
                             $_SESSION['achternaam'] = $row['achternaam'];
                             $_SESSION['tussenvoegsel'] = $row['tussenvoegsel'];
                             $_SESSION['voornaam'] = $row['voornaam'];
                             $_SESSION['straat'] = $row['straat'];
                             $_SESSION['huisnummer'] = $row['huisnummer'];
                             $_SESSION['toevoeging'] = $row['toevoeging'];
                             $_SESSION['postcode'] = $row['postcode'];
                             $_SESSION['plaats'] = $row['plaats'];
                             $_SESSION['telefoon'] = $row['telefoon'];
                             $_SESSION['foto'] = $row['foto'];
                             if(isSet($row['cv'])){$_SESSION['cv'] = $row['cv'];}
                             else {$_SESSION['cv'] = "";}
                             $_SESSION['geb-datum'] = $row['geboortedatum'];
                             $_SESSION['salaris'] = $row['salaris'];
                             $_SESSION['uitkering'] = $row['uitkering'];
                             //$_SESSION['uitkeringGeldigTot'] = date_format($row['uitkering_geldig_tot'], "F Y");
                             $_SESSION['uitkeringGeldigTot'] = $row['uitkering_geldig_tot'];
                             $_SESSION['bedrijf-grootte'] = $row['user_bedrijf_grootte'];
                             $_SESSION['rijbewijs'] = $row['rijbewijs'];
                             $_SESSION['auto'] = $row['auto'];
                             $_SESSION['reisafstand'] = $row['reisafstand'];
                             $_SESSION['linkedIn'] = $row['linkedin'];
                             $_SESSION['facebook'] = $row['facebook'];
                             $_SESSION['twitter'] = $row['twitter'];
                             $_SESSION['opmerking'] = $row['opmerking'];
                         }

}
    
    
    
    
    
    
function getAuthorisatie($usernaam)    
{
      global $connection;

      $auth = "usr";
      $sql = mysqli_query($connection, "SELECT * FROM `user`");
      if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if (strtolower($usernaam) == strtolower($row['user_inlognaam']))
            { 
            $auth = $row['user_authorisatie'];
            }
        }
      return $auth;
    }  

 function getPassword($usernaam)
    {
        global $connection;

        $pass = "";
        $sql = mysqli_query($connection, "SELECT * FROM `user`");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if (strtolower($usernaam) == strtolower($row['user_inlognaam']))
            { 
            $pass = $row['user_wachtwoord'];
            }
        }
      return $pass;
    }   
    

function error()
    {
        echo "<br/><br/>";
        echo "<h1>U bent nog niet ingelogd!</h1><br>";
        echo "Klik <a href=\"login.php\"> hier </a> om in te loggen<br>";
    }
    
function bedankt()
    {
        if (isSet($_SESSION["loginnaam"]))
        {
        echo "<h1>Bedankt</h1>";
        echo "Beste ".ucfirst($_SESSION["loginnaam"]).",<br>";
        echo "bedankt voor uw bezoek aan onze website. Tot ziens, tot de volgende keer.";
        }
    }

function showAanmeldForm($naam="",$email="")
    {
        global $email;
        global $naam;
        if(isSet($_POST['reglogin'])&& $_POST['reglogin']!=""){$naam = $_POST['reglogin']; }
        if(isSet($_POST['emailuser'])&& $_POST['emailuser']!=""){$email = $_POST['emailuser']; }
        echo "<section id=\"aanmeldblok\">";
        echo "<h4 class=instappen>Instappen werkzoekenden!<br/>";
        echo "Registreren</h4>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table id=\"login\">";
        echo "<tr><td>Typ uw login naam:</td>";
        echo "<td><input type='text' name='reglogin' value='".$naam."'</td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr><td>E-mailadres: </td>";
        echo "<td><input type='text' name='emailuser' value='".$email."'></td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr><td>Typ uw wachtwoord:</td>";
        echo "<td><input type='password' name='regpasswd1'</td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr><td>Herhaal uw wachtwoord:</td>";
        echo "<td><input type='password' name='regpasswd2'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='regsubmit' value='Registreren'>";
        echo "</form>";
        echo "</section>";
    }   
    
function handleAanmeldForm()
    {
        global $connection;
      
          if (isSet($_POST['regsubmit']) && isSet($_POST["regpasswd1"]) && $_POST["regpasswd1"] !=""
                && isSet($_POST["regpasswd2"]) && $_POST["regpasswd2"] !=""
                && isSet($_POST["reglogin"]) && $_POST["reglogin"] !="")
               {  

                       // Initialiseer fout variabelen
                       global $fout;
                       $fout=FALSE;
                       $naam_fout=False;
                       $email_fout=FALSE;
                       $naamdouble_fout=FALSE;
                       $emailsyntax_fout=FALSE;
                       $emaildouble_fout=FALSE;

                         // controleer op fouten
                         if ($_POST["reglogin"] == "")
	            {
	                $fout=TRUE;
	                $naam_fout=TRUE;
	             }

	         if ($_POST["emailuser"] == "")
	            {
	                $fout=TRUE;
	                $email_fout=TRUE;
	            }
        
                         $controle = check_email($_POST['emailuser']);//returncode van de functie check_email($email)is false of true  
                          if($controle == false)
                              {
                                   $fout=TRUE;
                                   $emailsyntax_fout=TRUE;
                               } 
        
                         $usrdouble = getUsername($_POST['reglogin']);
                         if ($usrdouble==true)
                             {
                                 $fout=TRUE;
                                 $naamdouble_fout=TRUE;
                             }
						      
                         $emaildouble = getUseremail($_POST['emailuser']);
                          if($emaildouble == true)
                             { 
                                    $fout=TRUE;
                                    $emaildouble_fout=TRUE;
                              }	 
							 
                                 // controleer of er fouten zijn
                         if($fout)
                            {
                                  // er zijn fouten
                                  // geef het lijstje van fouten
                                  echo "<div class=\"berichtAcc\">";
                                        echo "<UL><h4>";
                                             echo ($naam_fout?"<li>U heeft geen loginnaam ingevuld</li>":"");
                                             echo ($naamdouble_fout?"<li>Deze naam is al in gebruik</li>":"");
                                             echo ($email_fout?"<li><em>U heeft geen e-mailadres ingevuld</em></li>":"");
                                             echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":"");   
                                             echo ($emaildouble_fout?"<li><em>Dit email-adres wordt al gebruikt</em></li>":"");      
                                        echo "</h4></UL>";
                                 echo "</div>";
                                         // Geef het formulier opnieuw
                                        showAanmeldForm($naam="",$email="");       
                             }
                         else
                            {               
                                    // controle op dezelfde wachtwoorden (typfoutencheck)
                                  if ($_POST['regpasswd1']===$_POST['regpasswd2'])
                                        {
                                                    // er zijn geen fouten
                                                  echo "<h4 class=\"regdata\">Uw login gegevens:</h4>";
                                                  echo"<table class=\"gegevens\">";
                                                  echo "<tr><td>Loginnaam:</td><td><h5> ".$_POST["reglogin"]."</h5></td></tr>";
                                                  echo "<tr><td>E-Mail:</td><td><h5> ".$_POST['emailuser']."</h5></td></tr>";
                                                  echo "</table>";   
                                                  $_SESSION['loginnaam']= ucfirst($_POST['reglogin']);              
                                                  $_SESSION['regpasswd']=$_POST['regpasswd1'];
                                                  $code=uniqid(); // deze moet je zelf ook hebben om op te kunnen controleren later 
                                                  $_SESSION['code'] = $code;
                                                  reglinkVerzenden ($_POST['emailuser'],$_POST['regpasswd1'],$_SESSION['code']);
                     
                                                   $servername = "localhost:7777";
                                                   $username = "root";
                                                   $password = "123";
                                                   $dbname = "kandidaten";
                    
                                                  $sql = mysqli_query($connection, "INSERT INTO user (`user_inlognaam`, `user_wachtwoord`,`user_email`,`activ_code`)
                                                     VALUES ('".$_POST['reglogin']."', '".md5($_POST['regpasswd1'])."', '".$_POST['emailuser']."', '".$_SESSION['code']."')");
                                                      if (mysqli_affected_rows($connection)==0)
                                                           {
                                                                  //de gegevens zijn niet toegevoegd.
                                                                echo "error adding info, try again later";
                                                            } 
                                                     else
                                                          {                        
                                                                session_destroy();
                                                                echo "<div id=\"regInfo\">";
                                                                     echo "<h5 class=\"regdata\">";
                                                                              echo "Nadat u bent ingelogd kunt u verder gaan met de registratie<br>";
                                                                              echo "Er is een email verzonden naar  ".$_POST['emailuser']." met een activatie link,<br>";
                                                                              echo "u kunt<a href=\"login.php\"> inloggen </a> nadat u hierop heeft geklikt.";
                                                                     echo "</h5>";
                                                                echo "</div>";
                                                           }
                                        }                   
                                     else
                                        {  
                                                echo "<div class=\"berichtAcc\">";
                                                echo "De wachtwoorden komen niet overeen, probeer het nogmaals!</div><br>";
                                                showAanmeldForm($naam="",$email="");
                                        }
                                }
                } 
               else
                 if ($_POST["reglogin"] == "")
                     {
                          echo "<div class=\"berichtAcc\">";
                               echo "<h4>U heeft geen loginnaam ingevuld</h4>";
                          echo  "</div>";
                          showAanmeldForm($naam="",$email="");
                      }
                 else
                     { 
                          echo "<div class=\"berichtAcc\">";
                          echo "U moet wel een naam en 2x hetzelfde wachtwoord invullen!</div><br>";
                          showAanmeldForm($naam="",$email="");
                    }
		fFooter($pageNavId=1); 	
    } 
   
   
function getUsername($usernaam) //controle op dubbele loginnaam
    {
        global $connection;

        $usrdouble = false;
        $sql = mysqli_query($connection, "SELECT * FROM `user`");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if (strtolower($usernaam) == strtolower($row['user_inlognaam']))
            { 
            $usrdouble = true;
            }
        }
        return $usrdouble;
    }
    
    
function check_email($email) { // return TRUE or FALSE
  $patroon = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]{1,}\.)+([a-z0-9_-]{2,})$/i";
  return preg_match($patroon, $email);
}    


function uitloggen()
{
  global $connection;

  If(isSet($_SESSION['user_id']))
  {    
  $sql = mysqli_query($connection, "UPDATE `user` SET `user_online`='n' WHERE `user_id` = ".$_SESSION['user_id']." ") or die(mysqli_error());
  }
   // Unset all of the session variables.
  $_SESSION = array();
  session_destroy();        
              
}



function getUseremail($useremail) //controle op dubbele loginnaam
    { 
        global $connection;

        $emaildouble = false;
        $sql = mysqli_query($connection, "SELECT * FROM `user`");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if ($useremail == $row['user_email'])
            { 
            $emaildouble = true;
            }
        }
        return $emaildouble;
    }

function reglinkVerzenden ($regemail,$regpasswd,$code)
{

$code = $_SESSION['code'];
$subject = 'Uw registratie afronden';

/*$email="Uw Loginnaam: ".$_SESSION['loginnaam']." //server versie
Uw wachtwoord: ".$_SESSION['regpasswd']."
Klik op deze link: http://triplers.nl/humanic/application/modules/humanic-portal/verify.php?acode=$code ,om u te kunnen verifieren";*/

$email="Uw Loginnaam: ".$_SESSION['loginnaam']." 
Uw wachtwoord: ".$_SESSION['regpasswd']."
Klik op deze link: http://www.localhost:7777/HumanicIC/humanic/application/modules/humanic-portal/verify.php?acode=$code ,om u te kunnen verifieren";
$to = $regemail;
$from = 'humanic_info@outlook.com';

ini_set('sendmail_from', $from);

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: HumanIC <{$from}>";
$headers[] = "Reply-To: HumanIC <{$from}>";
//$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($to, $subject, $email, implode("\r\n", $headers) ); 
    
    
}


 function showContactForm($naam="",$email="",$subject="",$bericht="")
 {
   if(isSet($_POST['naam'])){$naam = $_POST['naam']; }
   if(isSet($_POST['email'])){$email = $_POST['email'];}
   if(isSet($_POST['subject'])){$subject = $_POST['subject'];}
   if(isSet($_POST['bericht'])){$bericht = $_POST['bericht'];}
   //echo "<p>";
   echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post>";
   echo "<table class=\table\">";
   echo "<tr><td id=\"contactL\">Name:</td><td id=\"contactR\"><input type='text' name='naam' value='$naam'></td></tr>";
   echo "<tr><td id=\"contactL\">E-mailadress:</td><td id=\"contactR\"><input type='text' name='email' value='$email'></td></tr>";
   echo "<tr><td id=\"contactL\">Subject:</td><td id=\"contactR\"><input type='text' name='subject' value='$subject'></td></tr>";
   echo "<tr><td id=\"contactL\">Message:</td><td id=\"contactR\">";
   echo "<textarea name=\"bericht\" cols=\"80\" rows=\"6\" value='$bericht'></textarea></td></tr>";
   echo "</table>";
   echo "<input type='submit' name='submit' value='Submit'>";
   echo "</form>";
   
   //echo "</p>";

 }
 
 function handleContactForm ()
 {
        global $connection;

          // Initialiseer fout variabelen
        $fout=FALSE;
        $naam_fout=FALSE;
        $naamsyntax_fout=FALSE;
        $email_fout=FALSE;
        $emailsyntax_fout=FALSE;
        $subject_fout=FALSE;
        $bericht_fout=FALSE;
     
             // controleer op lege velden
        if ($_POST["naam"] == "")
	{
	    $fout=TRUE;
	    $naam_fout=TRUE;
	}
       if ($_POST["email"] == "")
	{
	    $fout=TRUE;
	    $email_fout=TRUE;
	}
       if ($_POST["subject"] == "")
	{
	    $fout=TRUE;
	    $subject_fout=TRUE;
	}
        if ($_POST["bericht"] == "")
	{
	    $fout=TRUE;
	    $bericht_fout=TRUE;
	}     
       if(!valid_naam($_POST["naam"]))
        {
            $fout=TRUE;
            $naamsyntax_fout=TRUE;
        }
         $controle = check_email($_POST['email']);//returncode van de functie check_email($email)is false of true  
        if($controle == false)
               {
                  $fout=TRUE;
                  $emailsyntax_fout=TRUE;
                }
        
        // controleer of er fouten zijn
     if ($fout)
      {
           // er zijn fouten
           // geef het lijstje van fouten    
         /* echo "<UL>";
          echo ($naam_fout?"<li>U heeft geen naam ingevuld</li>":"");
          echo ($naamsyntax_fout?"<li>Deze naam is niet toegestaan</li>":"");
          echo ($email_fout?"<li>U heeft geen e-mailadres ingevuld</li>":"");
          echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":"");
          echo ($subject_fout?"<li>U heeft geen onderwerp ingevuld</li>":"");     
          echo ($bericht_fout?"<li>U heeft geen bericht ingevuld</li>":"");
          echo "</UL>";*/
         
          echo "<UL>";
          echo ($naam_fout?"<li>The name field is blank</li>":"");
          echo ($naamsyntax_fout?"<li>This name is not allowed</li>":"");
          echo ($email_fout?"<li>Enter an email address</li>":"");
          echo ($emailsyntax_fout?"<li><em>Enter a valid email address</em></li>":"");
          echo ($subject_fout?"<li>Enter a subject</li>":"");     
          echo ($bericht_fout?"<li>You have no message</li>":"");
          echo "</UL>";
          // Geef het formulier opnieuw
        showContactForm($_POST['naam'], $_POST['email'], $_POST['subject'], $_POST['bericht']);
      
      }

     else//Er zijn geen fouten
     {
       if(isSet($_SESSION['loginnaam']))
         {
          $sql = mysqli_query($onnection, "INSERT INTO contact (`user_id`,`user_inlognaam`, `contact_naam`,`contact_email`,`contact_subject`,`contact_bericht`)
              VALUES ('".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$_POST['naam']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['bericht']."')");
                 if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                      echo "<h3>Your message has been sent successfully.</h3>";
                      echo "<h4>These are your data:</h4><hr>";
                      echo "<table class=\table\">";
                      echo "<tr><td div id=\"messageL\">User ID:</td></div><td div id=\"messageR\"> ".$_SESSION['user_id']."</td></div></tr>";
                      echo "<tr><td id=\"messageL\">Login:</td><td id=\"messageR\"> ".$_SESSION['loginnaam']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Name:</td><td id=\"messageR\"> ".$_POST['naam']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Email:</td><td id=\"messageR\"> ".$_POST['email']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Subject:</td><td id=\"messageR\"> ".$_POST['subject']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Message:</td><td id=\"messageR\"> ".$_POST['bericht']."</td></tr>";
                      echo "</table>";                           
                    }        
            }
          else
            {
                   $sql = mysqli_query($connection, "INSERT INTO contact (`contact_naam`,`contact_email`,`contact_subject`,`contact_bericht`)
              VALUES ('".$_POST['naam']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['bericht']."')");
                 if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                        echo "<h3>Your message has been sent successfully</h3>";
                      echo "<h4>These are your data:</h4><hr>";
                      echo "<table class=\table\"><h5>";
                      echo "<tr><td id=\"contactL\">User ID:</td><td></td></tr>";
                      echo "<tr><td id=\"contactL\">User Loginname:</td><td></td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Name:</td><td id=\"contactR\"> ".$_POST['naam']."</td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Email:</td><td id=\"contactR\"> ".$_POST['email']."</td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Subject:</td><td id=\"contactR\"> ".$_POST['subject']."</td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Message:</td><td id=\"contactR\"> ".$_POST['bericht']."</td></tr>";
                      echo "</h5></table>";                                
                    }  
             }
     }
  
 }
 
 function showKandidaatRegForm () 
 { 
    global $connection;
    global $cvpath;
    echo " <div class=\"container\">";
            echo "<h1 class=\"profiel\">Je persoonlijk profiel</h1>";          
           echo "<form id=\"fuikweb-register\" action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=\"post\"  enctype=\"multipart/form-data\" role=\"form\">";
           // echo "<form id=\"data\" action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=\"post\"  enctype=\"multipart/form-data\" role=\"form\">"; 
                persoonlijkeGegevens();		                                               
                toonFuncties();
                echo "<section id=\"mobielFinUitkering\">";
                    toonMobielUitkering();
                    toonSector();
                echo "</section>";    
                toonRegio();
                toonOpmerkingen();
               $_files="";    
                echo "<section id=\"opslaan\">";
                        echo "<br><br>";
                        echo "<div class=\"text-right\">";
                            echo "<div >";
                            //echo "<input type='submit' name='submit' value='Verzenden'><br /><br />";
                            echo "<button id=\"submit\"class=\"col-sm-6 btn btn-primary btn-md\" type=\"submit\" name=\"submit\" value='Opslaan' >Opslaan</button><br/><br/><br/>";
                            //echo "<button class=\" col-sm-5 btn btn-primary btn-md\" type=\"button\" name=\"wissen\">Wissen</button>";
                        echo "</div>";	
                echo "</section>";
            echo "</form>";
    echo "</div>";
			
}

function handleKandidaatRegForm () 
 {
    
    if($_FILES['foto'])
                {
                    //echo "conditie 2, de foto is gewijzigd<br/>";
                    verwerkFoto();
                    }
   if($_FILES['cv'])
                {
                    //echo "conditie 3, de cv is veranderd<br/>";
                    verwerkCV();
                    }            
     verwerkUser();  
     verwerkFunctie();
     verwerkRegio();
     verwerkSector();
     verwerkBedrijfGewerkt();
     verwerkBedrijf();
     error_reporting(0);
     maakSessieVariabelen();
     header("Refresh:0");
     showKandidaatRegForm();
     error_reporting(E_ALL); 
 }
 
 function persoonlijkeGegevens(){
     global $imagepath;
     global $cvpath;
    $voornaam = variableWaarde('voornaam');
    $tussenvoegsel = variableWaarde('tussenvoegsel');
    $achternaam = variableWaarde('achternaam'); 
    $straat = variableWaarde('straat');
    $huisnr = variableWaarde('huisnummer');
    $toevoeging = variableWaarde('toevoeging');
    $postcode = variableWaarde('postcode');
    $woonplaats = variableWaarde('plaats');
    $telefoon = variableWaarde('telefoon');
    $geboorteDatum = variableWaarde('geb-datum');
    $email = variableWaarde('email');  // is al bekend in de aanmeld fase , zie aanmeld afhandeling vanaf r443
    $loginnaam = variableWaarde('loginnaam'); 
    if(isSet($_SESSION['cv']))
       {
          $cv = $_SESSION['cv'];
       }
    else 
        {
           $cv="";
           $_SESSION['cv']=$cv;
       }
    if(isSet($_SESSION['foto']))
       {
          $foto = $_SESSION['foto'];
       }
     else 
        {
           $foto="";
           $_SESSION['foto']=$foto;
       }  
    $linkedIn = variableWaarde('linkedIn');
    $facebook = variableWaarde('facebook');
    $twitter = variableWaarde('twitter');
        
    echo "<section id=\"persoonlijke-gegevens\">";
        echo "<section id=\"personalia\">";
            echo "<div class=\"kop\">";
                echo "<p>Vul je persoonlijke gegevens in, velden met een * zijn verplicht.</p>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3 text-left\" for=\"login-naam\">Loginnaam: </label>";
                //<input type="text" class='form-control' id="login-naam" name="LoginNaam" required="required" autofocus="autofocus"/> -->
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" id=\"login-naam\" name=\"LoginNaam\" value='$loginnaam' readonly/>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"achternaam\">Achternaam *</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"achternaam\" name=\"achternaam\" value='$achternaam' required=\"required\" autofocus=\"autofocus\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"tussenvoegsel\">Tussenvoegsel</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"tussenvoegsel\" name=\"tussenvoegsel\" value='$tussenvoegsel'/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3 text-left\" for=\"voornaam\">Voornaam *</label>";
                echo "<div class=\"col-sm-9\">";
                        echo "<input type=\"text\" class=\"form-control input-sm\" id=\"voornaam\" name=\"voornaam\" value='$voornaam' required=\"required\"  />";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\" col-sm-3\"  for=\"email\">Email</label>";
                echo "<div class=\"col-sm-9\">";                        
                    echo "<input type=\"email\" class=\"form-control input-sm\" id=\"email\" name=\"email\" value='$email'  />";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3 col-offset-1\" for=\"straat\">Straat </label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"straat\" name=\"straat\" value='$straat' />";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"huisnummer\">Huisnummer</label>";
                echo "<div class=\"col-sm-2\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"huisnummer\" name=\"huisnummer\" value=$huisnr >";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"toevoeging\">Toevoeging</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"toevoeging\" name=\"toevoeging\"/ value='$toevoeging'>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"postcode\">Postcode</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"postcode\" name=\"postcode\" value='$postcode' placeholder=\"1032CJ\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"plaats\">Plaats</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"plaats\" name=\"plaats\" value='$woonplaats'/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"geboortedatum\">Geboortedatum</label>";
                echo "<div class=\"col-sm-4\">";
                    echo "<input type=\"date\" class=\"form-control input-sm\" id=\"geboortedatum\" name=\"geboortedatum\" value='$geboorteDatum' placeholder=\"dd-mm-jjjj\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"telefoon\">Telefoon *</label>";
                echo "<div class=\"col-sm-4\">";
                    echo "<input type=\"tel\" class=\"form-control input-sm\" id=\"telnr\" name=\"telefoon\" value='$telefoon' autocomplete = \"on\" required=\"required\"/>";
                echo "</div>";	
            echo "</div>";
        echo "</section>";
        global $apppath;
        global $imagepath;
        global $cvpath;
 echo "<section id=\"sociaal_foto\">";
           echo "<div id=\"fotoDiv\" class=\"form-group\">";
                            
                    echo "<label  for=\"foto\">Foto uploaden</label>";
                    echo "<div>";
                    
                            //if($_SESSION['foto']){
                           // echo "<img class=\"col-sm-4\" id=\"myImg\" src=\"$imagepath"."$foto\" alt=\"your image\" width=80px height=80px style=\"margin: 5px;\"/>";
                                echo "<img class=\"col-sm-3\" id=\"myImg\" src=\"$imagepath"."$foto\" alt=\"your image\" width=100px height=100px style=\"margin: 5px;\"/>";
                             //   }
                            echo "<input class=\"col-sm-5 btn btn-primary btn-sm\" type=\"file\" id=\"foto\" name=\"foto\"  />";
                            
                    echo "</div>";      
         echo "</div>";
 echo "</section>";           //echo "</div>";
 echo "<section id=\"cv-upload\">";      
            echo "<div id=\"cvDiv\" class=\"form-group\">";
                 echo "<label  for=\"cv\">CV uploaden</label>";
                 echo "<div>";
                        if ($_SESSION['cv'] != ""){ 
                            echo "<p class=\"col-sm-4\">Uw <a id=\"cvRef\" href=\"$cvpath".$_SESSION['cv']."\"  TARGET=\"_blank\">cv inzien.</a></p>";
                        }
                         //echo "mark>CV UPLOADEN.</mark><br/><br/>";
                        echo "<input class=\"col-sm-5 btn btn-primary btn-sm\" type=\"file\" class=\"form-control\" id=\"cv\" name=\"cv\"  />";
                        echo "<p class=\"col-sm-12\" id=\"fotoMelding\">Let op. De foto wordt pas opgeslagen na het opslaan van het formulier! De nieuwe CV is dan ook zichtbaar.</p>";
                      //echo "<button class=\"col-sm-4 btn btn-primary btn-sm cv\" type=\"button\" id=\"buttonCv\">CV uploaden</button>";//JS versie Thijs
                   // echo "een nieuwe cv<a href=\"$apppath//application/modules/humanic-portal/cv-upload.php\" ><mark> uploaden.</mark></a>";// dit is als voorbeeld voor thijs hoe je nieuwe pagina toevoegd
                 echo "</div>";
            echo "</div>";            
 echo "</section>";
        
        echo "<section id=\"sociale_media\">";
            echo "<div class=\"form-group\">";
                echo "<label class=\"control-label col-sm-3\" for=\"linkedin\">LinkedIn</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"linkedin\" name=\"linkedIn\" value='$linkedIn'  placeholder=\"linkedIn link\" />";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"form-group\">";
                echo "<label class=\"control-label col-sm-3\" for=\"facebook\">Facebook</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"facebook\" name=\"facebook\" value='$facebook' placeholder=\"facebook link\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"form-group\">";
                echo "<label class=\"control-label col-sm-3\" for=\"twitter\">Twitter</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"twitter\" name=\"twitter\" value='$twitter' placeholder=\"twitter link\"/>";
                echo "</div>";	
            echo "</div>";
        echo "</section>";
    echo "</section>";	


    
    
 }
 function verwerkFunctie() {
    global $connection;
    global $functieArray;
    $functies = $_SESSION['functies'];
    $aantal_rijen = $_SESSION['aantal_rijen'];
   
    $checkFunctie = array();
    if (!empty($_POST['functie_List'])) {
        foreach ($_POST['functie_List'] as $selected){            
            $ervaring = bepaalErvaring($selected);
            array_push($checkFunctie, $selected);
        }
        
    }
        
    for ($i=0; $i<$aantal_rijen; $i++){
        $functieId = $functies[$i][0];
        $functieIndex = array_search($functieId, array_column($functieArray, 0));
        if (is_numeric($functieIndex)){
            
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($functieId, $checkFunctie);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `functie_id` = '".$functieId."'");
            }
            else {
                //functie is aangevinkt, controle of ervaring gewijzigd is
                //$ervaring = bepaalErvaring($checkFunctie[$checkIndex]);
                
                $ervaring = $_POST['ervaring'.$functieId.''];
                
                if (ISSET($_POST['nwFunctie'])){
                    $nwFunctie = $_POST['nwFunctie'];
                }
                else {
                    $nwFunctie = " ";
                }
                
                if (($functieArray[$functieIndex][1] <> $ervaring) || ($functieArray[$functieIndex][2] <> $nwFunctie)){
                    //ervaring of nieuwe functie is gewijzigd
                        $sql = mysqli_query($connection, "UPDATE user_functie SET `ervaring` = '".$ervaring."', `nwFunctie` = '".$nwFunctie."' WHERE `user_id`='".$_SESSION["user_id"]."' AND `functie_id` = '".$functieId."'");
                }
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($functieId, $checkFunctie);
            if (is_numeric($checkIndex)){
                 //functie is aangevinkt
                $ervaring = $_POST['ervaring'.$functieId.''];
                if (ISSET($_POST['nwFunctie'])){
                    $nwFunctie = $_POST['nwFunctie'];
                }
                else {
                    $nwFunctie = " ";
                }
                
               // $functieId = $checkFunctie[$checkIndex];
               $sql = mysqli_query($connection, "INSERT INTO user_functie (`user_id`,`functie_id`, `ervaring`, `nwFunctie`)
                        VALUES ('".$_SESSION['user_id']."', '".$functieId."', '".$ervaring."', '".$nwFunctie."')");
            }       
        }       
            
    }
    };
            

 
 function bepaalErvaring($selected) {
     switch ($selected) {
        case 1 :
            return $_POST['ervaring1'];
            break;
        case 2 :
            return $_POST['ervaring2'];
            break;
        case 3 :
            return $_POST['ervaring3'];
            break;
        case 4 :
            return $_POST['ervaring4'];
            break;
        case 5 :
            return $_POST['ervaring5'];
            break;
        case 6 :
            return $_POST['ervaring6'];
            break;
        case 7 :
            return $_POST['ervaring7'];
            break;
        case 8 :
            return $_POST['ervaring8'];
            break;
        case 9 :
            return $_POST['ervaring9'];
            break;
        case 10 :
            return $_POST['ervaring10'];
            break;
        case 99 :
           return $_POST['ervaring99'];
            break;
        default:
            break;
    }
 };
 
 function toonFuncties(){
    global $connection;
    global $functieArray;
   
    
    //de functies uit de functietabel ophalen
    $sql = mysqli_query($connection, "SELECT * FROM `functie` ORDER BY `functie_id`");
                                                                                
    if (mysqli_num_rows($sql)==0)  
      {
          die ("Er zijn geen functies aanwezig");
      }; 
      
    $aantal_rijen = mysqli_num_rows($sql); //aantal rijen in de functietabel
    $_SESSION['aantal_rijen'] = $aantal_rijen;
    $midden = round($aantal_rijen / 2); //voor het bepalen wanneer functieVak2 moet worden getoond
 
    $functies = array(); //array om alle gegevens van functies bij te houden
 
    while ($row = mysqli_fetch_assoc($sql)){
        $id = $row['functie_id'];
        
        $functieZoek = array_search($id, array_column($functieArray, 0));
        if (IS_NUMERIC($functieZoek)){
            $functieElementen = array($row['functie_id'], $row['functie_naam'], $row['functie_omschrijving'],$functieArray[$functieZoek][1], "checked='checked'", $functieArray[$functieZoek][2] );                        
        }
        else {
            $functieElementen = array($row['functie_id'], $row['functie_naam'], $row['functie_omschrijving'],0 ,"" , "");             
        };
        array_push($functies, $functieElementen);
    };
    $_SESSION['functies'] = $functies;
     
    echo "<section id=\"functies\">";
        echo "<div class=\"kop\">";
                echo "<p>Vink de functie(s) aan waarin je geinteresseerd bent en geef je werkervaring aan in die functie(op een schaal van 1 tot 10)";
        echo "</div>";                        
                          
        echo "<div class=\"functieVak1\">";
            for($i=0; $i<$aantal_rijen; $i++){
                if ($i == ($midden)){
                   echo "</div>";
                   echo "<div class=\"functieVak2\">"; 
                }

                $functieId = $functies[$i][0];
                $functieNaam = $functies[$i][1];
                $functieInfo = $functies[$i][2];
                $functieErvaring = $functies[$i][3]; 
                $functieCheck = $functies[$i][4];
                $functieNieuw = $functies[$i][5];

            echo "<div class=\"form-group\">";
                    if ($functieId != 99){
                        echo "<label class=\"col-sm-7 text-left\">
                                <input id=\"functieCheck".$functieId."\" type=\"checkbox\"  name=\"functie_List[]\" value=".$functieId." $functieCheck> ".utf8_encode($functieNaam)."
                                <span class=\"text\" ><img src=\"".$GLOBALS['imagepath']."info-icon.png\" alt=\"info\" height=\"17\" width=\"12\"></img></span>
                                <div class=\"info\"> ".utf8_encode($functieInfo)."
                                </div>
                            </label>";
                    }
                    else {
                        echo "<label class=\"col-sm-7 text-left\">";
                                echo "<input id=\"functieCheck".$functieId."\" type=\"checkbox\"  name=\"functie_List[]\" value=\"99\" $functieCheck\> ".utf8_encode($functieNaam)."";
                            echo "</label>";
                            echo "<div id=\"nwFunctie\" class=\"col-sm-7\">";
                                    echo "<input type=\"text\" name=\"nwFunctie\" placeholder=\"nieuwe functie\" value=".utf8_encode($functieNieuw).">";
                            echo "</div>";
                    }
                    echo "<div  id=\"ervaringSlider".$functieId."\" class=\"ervaringSlider col-sm-5\">";
                        echo "<input id=\"ervaring".$functieId."\" data-slider-id=\"ervaringSlider".$functieId."\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$functieErvaring  width=\"5px\" name=\"ervaring".$functieId."\" tooltip=\"hide\" size=\"5\"/>";		
                        echo "<div>"; 
                            echo "<span  id=\"ex".$functieId."CurrentSliderValLabel\"> <span id=\"ex".$functieId."SliderVal\">$functieErvaring</span></span>";
                        echo "</div>";
                    echo "</div>";
            echo "</div>";
                
                echo "<script type=\"text/javascript\">
                    if ($(\"#functieCheck".$functieId."\").prop(\"checked\") === true) {
                            $(\"#ervaringSlider".$functieId."\").show();
                            if ($functieId == 99){
                                $(\"#nwFunctie\").show();
                            }

                            $('#ervaring".$functieId."').slider({
                                tooltip : 'hide',
                                formatter: function(value) {
                                    return 'Current value: ' + value;
                                }
                            });
                            
                            $(\"#ervaring".$functieId."\").on(\"slide\", function(slideEvt) {
                                    $(\"#ex".$functieId."SliderVal\").text(slideEvt.value); 
                            });
                            
                            $(\"#ervaring".$functieId."\").on(\"slideStop\", function(slideEvt) {
                                    $(this).val($(this).data('slider').getValue()); 
                            });
                        }
                        else {					
                            $(\"#ervaringSlider".$functieId."\").hide();
                            if ($functieId == 99){
                                $(\"#nwFunctie\").hide();
                            }
                    };

                    //controle
                    $(\"#functieCheck".$functieId."\").change(function() {
                        if ($(\"#functieCheck".$functieId."\").prop(\"checked\") == true) {
                                $(\"#ervaringSlider".$functieId."\").show();
                                if ($functieId == 99){
                                    $(\"#nwFunctie\").show();
                                }

                                $('#ervaring".$functieId."').slider({
                                        value : 0,
                                        tooltip : 'hide',
                                        formatter: function(value) {
                                            return 'Current value: ' + value;
                                        }
                                });
                                $(\"#ervaring".$functieId."\").on(\"slide\", function(slideEvt) {
                                        $(\"#ex".$functieId."SliderVal\").text(slideEvt.value); 
                                });
                                $(\"#ervaring".$functieId."\").on(\"slideStop\", function(slideEvt) {
                                        $(this).val($(this).data('slider').getValue()); 
                                });

                        }
                        else {					
                                $(\"#ervaringSlider".$functieId."\").hide();
                                if ($functieId == 99){
                                    $(\"#nwFunctie\").hide();
                                }
                        }
                    });
                </script>";
 
              }                              
        echo "</div>";
    echo "</section>";
    
   
 
 };
 
 function variableWaarde($variable){
     if (isset($_SESSION[$variable]) && !isSet($_POST[$variable])){
         return $_SESSION[$variable];
     }
     elseif(isSet($_POST[$variable])) {
         return $_POST[$variable];
     }
     else
         {
         return "\"\"";
     }
 };
 
 function toonMobielUitkering () {
    
    $rijbewijs = variableWaarde('rijbewijs');
    if (isSet($rijbewijs) && $rijbewijs=='ja'){
        $checkRijbewijs = "checked='checked'";
    }
    else {
        $checkRijbewijs = " ";
    }
  $auto = variableWaarde('auto');
    if (isSet($auto) && $auto=='ja'){
        $checkAuto = "checked='checked'";
    }
    else {
        $checkAuto = " ";
    }
    
    $salaris = variableWaarde('salaris');
    $uitkering = variableWaarde('uitkering');
    
    $uitkeringGeldigTot = variableWaarde('uitkeringGeldigTot');
    /*if ($uitkeringGeldigTot != " "){
        $date = new DateTime($uitkeringGeldigTot);
        $uitkeringGeldigTot = date_format($date, 'M-Y');
    }*/
    
    $selectWW; $selectWajong; $selectIOAW; $selectBijstand = "";
    switch ($uitkering) {
        case 'WW' : 
            $selectWW = "selected";
            break;
        case 'Wajong' : 
            $selectWajong = "selected";
            break;
        case 'IOAW' : 
            $selectIOAW = "selected";
            break;
        case 'Bijstand' : 
            $selectBijstand = "selected";
            break;
        case 'Geen ZZP' : 
            $selectGeenZzp = "selected";
            break;
        case 'Geen Bijstand' : 
            $selectGeenBijstand = "selected";
            break;
    }

    
    

    echo "<section id=\"mobielFinancieel\">";
        echo "<div id =\"rijbewijs\" class=\"form-group\">";
            echo "<label class=\"col-sm-12 text-left\"><input id=\"rijbewijsCheck\" type=\"checkbox\" value=$rijbewijs  name=\"rijbewijs\" $checkRijbewijs > Rijbewijs</label>";					
        echo "</div>";
        echo "<div class=\"form-group\" id=\"auto\">";
            echo "<label class=\"col-sm-12 text-left\"><input id=\"autoCheck\" type=\"checkbox\" value=$auto name=\"auto\" $checkAuto> Auto</label>";					
        echo "</div>";
        echo "<div class=\"form-group\" id=\"financieel\">";
            echo "<label class=\"col-sm-5\" for=\"salaris\">Salaris indicatie</label>";
            echo "<div class=\"col-sm-5\">";
                echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"salaris\" value=$salaris>";	
            echo "</div>";	
        echo "</div><br/><br/>";
        echo "<div class=\"form-group\" id=\"uitkering\">";
            echo "<label class=\"col-sm-5 \" for=\"uitkering\">Soort uitkering</label>";
            echo "<div class=\"col-sm-4\">";
                echo "<select class=\"form-control input-sm\" name=\"uitkering\" value=$uitkering>";
                    echo   "<option value=\"WW\" $selectWW>WW</option>
                            <option value=\"IOAW\" $selectIOAW>IOAW</option>
                            <option value=\"Wajong\" $selectWajong>Wajong</option>
                            <option value=\"WAO\" $selectBijstand>WAO</option>
                            <option value=\"Geen ZZP\" $selectGeenZzp>Geen ZZP'er</option>
                            <option value=\"Geen Bijstand\" $selectGeenBijstand>Geen Bijstand</option>";
                echo "</select>";
            echo "</div>";	
        echo "</div><br/><br/>";
        echo "<div class=\"form-group\" id=\"ww\">";
            echo "<label class=\"col-sm-5\" for=\"salaristkeringGeldigTot\">Uitkering geldig tot</label>";
            echo "<div class=\"col-sm-6\">"; // de class stond op col-sm-4 , daardoor zag ik in het formulier alleen dd-mm
                echo "<input type=\"date\" class=\"form-control input-sm\" id=\"geldigTot\" name=\"uitkeringGeldigTot\" value=$uitkeringGeldigTot placeholder=\"mm-jjjj\" />";
            echo "</div>";	
        echo "</div>";
    echo "</section>";	

 }
 
  function bepaalSectorErvaring($selected) {
     switch ($selected) {
        case 1 :
            return $_POST['sectorErvaring0'];
            break;
        case 2 :
            return $_POST['sectorErvaring1'];
            break;
        case 3 :
            return $_POST['sectorErvaring2'];
            break;
        case 4 :
            return $_POST['sectorErvaring3'];
            break;
        
        default:
            break;
    }
 }; 
 
 
 function toonSector() {
    global $connection;
    global $sectorArray;// de sectorArray wordt in kandidaat.php gemaakt en bestaat uit een collectie van de sector id's voor de user in de huidige sessie
    global $bedrijfArray;
    global $gewensteSectorArray;
    global $bedrijfGewerktArray;
    
        $checkedGewensteSector = array();
        for ($i = 1; $i <= 4; $i++){//de sector id's zijn 1 t/m 4
            $gewensteSectorIndex = array_search($i, array_column($gewensteSectorArray, 0));//verzamel de sector id's van de huidige user en stop ze in de array $sectorIndex
            if (IS_NUMERIC($gewensteSectorIndex)){
                array_push($checkedGewensteSector, "checked='checked'");        
            }
            else {
                array_push($checkedGewensteSector, "");
            };
        };
    

        $checkedSector = array();
        $sectorErvaring = array();
        for ($i = 1; $i <= 4; $i++){//de sector id's zijn 1 t/m 4
            $sectorIndex = array_search($i, array_column($sectorArray, 0));//verzamel de sector id's van de huidige user en stop ze in de array $sectorIndex
            if (IS_NUMERIC($sectorIndex)){
                array_push($checkedSector, "checked='checked'");        
                array_push($sectorErvaring, $sectorArray[$sectorIndex][1]);
            }
            else {
                array_push($checkedSector, "");
                array_push($sectorErvaring, 0);
            };
        };

     $checkedBedrijf = array();
        for ($i = 1; $i <= 4; $i++){
            $bedrijfIndex = array_search($i, array_column($bedrijfArray, 0));
            if (IS_NUMERIC($bedrijfIndex)){
                array_push($checkedBedrijf, "checked='checked'");
            }
            else {
                array_push($checkedBedrijf, "");
            };
        };   
        
       $checkedBedrijfGewerkt = array();

        for ($i = 1; $i <= 4; $i++){
            $bedrijfGewerktIndex = array_search($i, array_column($bedrijfGewerktArray, 0));
            if (IS_NUMERIC($bedrijfGewerktIndex)){
                array_push($checkedBedrijfGewerkt, "checked='checked'");
            }
            else {
                array_push($checkedBedrijfGewerkt, "");
            };
        };
 
        
              
echo "<section id=\"sectorwerk\">";
    echo "<div id=\"sector\">";
        echo "<div class=\"kop\">";
            echo "<p class=\"col-sm-12\" >Vink de sector(s) aan waar je in werkzaam bent geweest en geef aan hoeveel jaren je gewerkt hebt</p>";
        echo "</div>";
        echo "<div>";
            echo "<label class=\"col-sm-6 checkbox-inline\">";
                echo "<input type=\"checkbox\" value=1  name=\"sector_List[]\" $checkedSector[0]>ICT  ";
                echo "<input type=\"text\" class=\"sectorErvaring\" name=\"sectorErvaring0\" size=\"1\" style=\"text-align:center\" value=$sectorErvaring[0]> jaar gewerkt";	
            echo "</label>";
        
            echo "<label class=\"col-sm-5 checkbox-inline\">";
                echo "<input type=\"checkbox\" value=2 name=\"sector_List[]\" $checkedSector[1]>Zorg  ";
                echo "<input type=\"text\" class=\"sectorErvaring\" name=\"sectorErvaring1\" size=\"1\" style=\"text-align:right\" value=$sectorErvaring[1]> jaar gewerkt";	
            echo "</label>";
        echo "</div>";
        echo "<div>";
            echo "<label class=\"col-sm-6 checkbox-inline\">";
                echo "<input type=\"checkbox\" value=3 name=\"sector_List[]\" $checkedSector[2]>Industrie  ";
                echo "<input type=\"text\" class=\"sectorErvaring\" name=\"sectorErvaring2\" size=\"1\" style=\"text-align:right\" value=$sectorErvaring[2]> jaar gewerkt";	
            echo "</label>";
        
            echo "<label class=\"col-sm-5 checkbox-inline\">";
                echo "<input type=\"checkbox\" value=4 name=\"sector_List[]\" $checkedSector[3]>Retail  ";
                echo "<input type=\"text\" class=\"sectorErvaring\" name=\"sectorErvaring3\" size=\"1\" style=\"text-align:right\" value=$sectorErvaring[3]> jaar gewerkt";
            //echo "<input type=\"text\" class=\"form-control input-sm\" id=\"sectorErvaring3\" name=\"sectorErvaring3\" value=$sectorErvaring[3]>";	
            echo "</label>";
        echo "</div>";
    
        echo "<div class=\"kop\">"; 
            echo "<p class=\"col-sm-12\">Vink de grootte aan van de bedrijven je gewerkt hebt</p>";
        echo "</div>";    
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=1 name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[0]>micro (< 10)";
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=2 name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[1]>klein (<50)";
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=3 name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[2]>middelgroot (< 250)";
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
                echo "<input type=\"checkbox\" value=4 name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[3]>groot (> 250)";
        echo "</label>";
    echo "</div>"; 


    echo "<div id=\"bedrijf\">";
        echo "<div class=\"kop\">";
            echo "<p class=\"col-sm-12\">Gewenste ICT-SECTOR</p>";
        echo "</div>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=1  name=\"gewenste_Sector_List[]\" $checkedGewensteSector[0]>ICT ";	
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=2 name=\"gewenste_Sector_List[]\" $checkedGewensteSector[1]>Zorg";	
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=3 name=\"gewenste_Sector_List[]\" $checkedGewensteSector[2]>Industrie";	
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=4 name=\"gewenste_Sector_List[]\" $checkedGewensteSector[3]>Retail";	
        echo "</label>";

    //echo"<hr>";     
        echo "<div class=\"kop\">"; 
            echo "<p class=\"col-sm-12\">Gewenste grootte van het bedrijf</p>";
        echo "</div>"; 
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=1 name=\"bedrijf_List[]\" $checkedBedrijf[0]>micro (< 10)";
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=2 name=\"bedrijf_List[]\" $checkedBedrijf[1]>klein (<50)";
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=3 name=\"bedrijf_List[]\" $checkedBedrijf[2]>middelgroot (< 250)";
        echo "</label>";
        echo "<label class=\"checkbox-inline\">";
            echo "<input type=\"checkbox\" value=4 name=\"bedrijf_List[]\" $checkedBedrijf[3]>groot (> 250)";
        echo "</label>";
    echo "</div>";    

echo "</section>";
  
 }; 
 
 function toonRegio(){
    global $regioArray;
    
    echo "<section id=\"regio\">";
        $checkedRegio = array();

        $reisafstand = variableWaarde('reisafstand');
        
        for ($i = 1; $i <= 16; $i++){
            $regioIndex = array_search($i, array_column($regioArray, 0));
            if (IS_NUMERIC($regioIndex)){
                array_push($checkedRegio, "checked='checked'");
            }
            else {
                array_push($checkedRegio, "");
            };
        };

        echo "<section class=\"afstand\">";
            echo "<div class=\"col-sm-12 kop\">";
                echo "<p>Geef de maximale reisafstand</p>";
            echo "</div>";	
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3\" for=\"reisafstand\">Reisafstand</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"reisafstand\" name=\"reisafstand\" value=$reisafstand placeholder=\"in km\" />";
                echo "</div>";
            echo "</div>";	
        echo "</section><br/><br/>";

        echo "<section class=\"plaatspref\">";
            echo "<div class=\"col-sm-12 kop\">";
                    echo "<p>Vink de gewenste regio's aan</p>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=1 $checkedRegio[0]> Noord-Holland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=5 $checkedRegio[4]> Limburg";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=9 $checkedRegio[8]> Flevoland";
                echo "</label>";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=13 $checkedRegio[12]> Amsterdam e.o.";
                echo "</label>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=2 $checkedRegio[1]> Zuid-Holland";
                echo "</label>";

                echo "<label class=\"col-sm-3\"\>";
                        echo "<input type=\"checkbox\" name=\"regio_List[]\" value=6 $checkedRegio[5]> Gelderland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=10 $checkedRegio[9]> Drenthe";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=14 $checkedRegio[13]> Rotterdam";
                echo "</label>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=3 $checkedRegio[2]> Zeeland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=7 $checkedRegio[6]> Overijssel";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=11 $checkedRegio[10]> Groningen";
                echo "</label>";

              /*  echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=15 $checkedRegio[14]> Utrecht";
                echo "</label>";*/
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=4 $checkedRegio[3]> Noord-Brabant";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=8 $checkedRegio[7]> Utrecht";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=12 $checkedRegio[11]> Friesland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=16 $checkedRegio[15]> Eindhoven";
                echo "</label>";
            echo "</div>";
			echo "<div class=\"plaatspref\"></div> ";
        echo "</section>";
    echo "</section>";
 };
 
 function toonOpmerkingen() {
    //$opmerking = $_SESSION['opmerkingen']; 
    
    echo "<section id=\"opmerkingSection\">";
        echo "<div class=\"col-sm-12 kop\">";
                echo "<p>Opmerkingen</p>";
        echo "</div>";	
        echo "<div class=\"col-sm-6\">";
                $opmerking = variableWaarde('opmerking');
                
                echo "<textarea class=\"form-control\"  name=\"opmerking\"  rows=\"5\">$opmerking	</textarea>";									 
        echo "</div>";	
        echo "<br>";
    echo "</section>";
 };
 
 function verwerkRegio() {
    global $connection;
    global $regioArray;
   
    $checkRegio = array();
    if (!empty($_POST['regio_List'])) {
        foreach ($_POST['regio_List'] as $selected){            
            array_push($checkRegio, $selected);
        }
    }
    for ($i=1; $i<=16; $i++){
        $regioIndex = array_search($i, array_column($regioArray, 0));
        if (is_numeric($regioIndex)){
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkRegio);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_regio WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `regio_id` = '".$i."'");
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkRegio);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt
                
                $regioId = $checkRegio[$checkIndex];
     
               $sql = mysqli_query($connection, "INSERT INTO user_regio (`user_id`,`regio_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$regioId."')");
            }             
        }
    }
 }; 
 
function verwerkSector() {
    global $connection;
    global $sectorArray;
    global $gewensteSectorArray;
   
    $sectorErvaring = array();
    $checkSector = array();
    if (!empty($_POST['sector_List'])) {
        foreach ($_POST['sector_List'] as $selected){            
            array_push($checkSector, $selected);// alle in het formulier geselecteerde sectoren in de array $checkSector stoppen
            $sectorErvaring = bepaalSectorErvaring($selected);// de switch uit de functie bepaalSectorErvaring gebruiken om de bijbehorende ervaring aan de gesecteerde sector te koppelen 
        }
 
       
    }
        
    for ($i=1; $i<=4; $i++){
        $sectorIndex = array_search($i, array_column($sectorArray, 0));// kijk welke sector_id's al in de database voor komen
        if (is_numeric($sectorIndex)){
            //sector is gevonden, dus komt al voor in database
            $checkIndex = array_search($i, $checkSector);// check of het in het formulier wel is aangevinkt
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_sector WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `sector_id` = '".$i."'");
            } 
            else{//in het formulier ook aangevinkt, kijk of de sectorErvaring gewijzigd is
                 $sectorErvaring = bepaalSectorErvaring($checkSector[$checkIndex]);
                if ($sectorArray[$sectorIndex][1] <> $sectorErvaring){
                    //ervaring is gewijzigd
                    $sql = mysqli_query($connection, "UPDATE user_sector SET `jaren` = '".$sectorErvaring."' WHERE `user_id`='".$_SESSION["user_id"]."' AND `sector_id` = '".$i."'");
                }
                else {
                    //ervaring is niet gewijzigd, geen query draaien
                }
            }
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkSector);// check of het in het formulier wel is aangevinkt
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt , hoeft niets te geburen
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt en komt nog niet voor in de database, moet dus in de database komen
                $sectorId = $checkSector[$checkIndex];
               $sectorErvaring = bepaalSectorErvaring($checkSector[$checkIndex]);
               $sql = mysqli_query($connection, "INSERT INTO user_sector (`user_id`,`sector_id`, `jaren`)
                        VALUES ('".$_SESSION['user_id']."', '".$sectorId."', '".$sectorErvaring."')");
            }             
        }
    }
    
   function verwerkBedrijfGewerkt() {
    global $connection;
    global $bedrijfGewerktArray;
   
    $checkBedrijfGewerkt = array();
    if (!empty($_POST['bedrijfGewerkt_List'])) {
        foreach ($_POST['bedrijfGewerkt_List'] as $selected){            
            array_push($checkBedrijfGewerkt, $selected);
        }
    }
        
    for ($i=1; $i<=4; $i++){
        $bedrijfGewerktIndex = array_search($i, array_column($bedrijfGewerktArray, 0));
        if (is_numeric($bedrijfGewerktIndex)){
            //bedrijfgroote is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkBedrijfGewerkt);//check of het ook in het formulier aangevinkt is
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM bedrijfgewerkt WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `bedrijf_id` = '".$i."'");
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkBedrijfGewerkt);
            if (!is_numeric($checkIndex)){
                //en ook niet aangevinkt nin het formulier, hoeft dus geen actie ondernomen te worden
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //zit niet in de database, maar functie is wel in het formulier aangevinkt
                $bedrijfId = $checkBedrijfGewerkt[$checkIndex];
               $sql = mysqli_query($connection, "INSERT INTO bedrijfgewerkt (`user_id`,`bedrijf_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$bedrijfId."')");
            }             
        }
    }
 };  
    
    
 //verwerking gewenste sector
    $checkGewensteSector = array();
    if (!empty($_POST['gewenste_Sector_List'])) {
        foreach ($_POST['gewenste_Sector_List'] as $selected){            
            array_push($checkGewensteSector, $selected);// alle in het formulier geselecteerde sectoren in de array $checkSector stoppen           
        }
 
       
    }
        
    for ($i=1; $i<=4; $i++){
        $gewensteSectorIndex = array_search($i, array_column($gewensteSectorArray, 0));// kijk welke sector_id's al in de database voor komen
        if (is_numeric($gewensteSectorIndex)){
            //sector is gevonden, dus komt al voor in database
            $checkIndex = array_search($i, $checkGewensteSector);// check of het in het formulier wel is aangevinkt
            if (!is_numeric($checkIndex)){
                //gewenste sector is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM gewenste_sector WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `sector_id` = '".$i."'");
            } 

        }
        else {
            //gewenste sector_id zit nog niet in database
            $checkIndex = array_search($i, $checkGewensteSector);// check of het in het formulier wel is aangevinkt
            if (!is_numeric($checkIndex)){
                //gewenste sector_id is niet aangevinkt , hoeft niets te geburen
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //gewenste sector_id is aangevinkt en komt nog niet voor in de database, moet dus in de database komen
                $gewensteSectorId = $checkGewensteSector[$checkIndex];echo "sector_id: '".$gewensteSectorId."'";
               $sql = mysqli_query($connection, "INSERT INTO gewenste_sector (`user_id`,`sector_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$gewensteSectorId."')");
            }             
        }
    }
    
    
    
    
 }; 
 
 function verwerkBedrijf() {
    global $connection;
    global $bedrijfArray;
   
    $checkBedrijf = array();
    if (!empty($_POST['bedrijf_List'])) {
        foreach ($_POST['bedrijf_List'] as $selected){            
            array_push($checkBedrijf, $selected);
        }
    }
        
    for ($i=1; $i<=16; $i++){
        $bedrijfIndex = array_search($i, array_column($bedrijfArray, 0));
        if (is_numeric($bedrijfIndex)){
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkBedrijf);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_bedrijf WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `bedrijf_id` = '".$i."'");
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkBedrijf);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt
                $bedrijfId = $checkBedrijf[$checkIndex];
               $sql = mysqli_query($connection, "INSERT INTO user_bedrijf (`user_id`,`bedrijf_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$bedrijfId."')");
            }             
        }
    }
 };
 
 function verwerkUser() {
    
     global $connection;
        $user_id = $_SESSION['user_id'];
        $telefoon = checkPost('telefoon');        
        $voornaam = checkPost('voornaam');
        $tussenvoegsel = checkPost('tussenvoegsel');
        $achternaam = checkPost('achternaam');
        $straat = checkPost('straat');
        $huisnummer = checkPost('huisnummer');
        $toevoeging = checkPost('toevoeging');
        $postcode = checkPost('postcode');
        $rijbewijs = checkPost('rijbewijs');
        $auto = checkPost('auto');
        $woonplaats = checkPost('plaats');
        $gebdat = checkPost('geboortedatum');
        //$gebdat = "'".$gebdat."'01";
        $foto = $_SESSION['foto'];
        $cv = $_SESSION['cv'];
        $email = checkPost('email');
        $salaris = checkPost('salaris');
        $uitkering = checkPost('uitkering');
        $uitkeringGeldigTot = checkPost('uitkeringGeldigTot'); 
        //$rijbewijs = checkPost('rijbewijs');
        if(isSet($_POST['rijbewijs']))
            {
                $rijbewijs='ja';
            }
        else
            {
                $rijbewijs='nee';
            }
        if(isSet($_POST['auto']))
            {
                $auto='ja';
            }
        else
            {
                $auto='nee';
            }
           // echo "Rijbewijs: '".$rijbewijs."' <br/>";echo "Auto: '".$auto."' <br/>";
        //$auto = checkPost('auto');
        $reisafstand = checkPost('reisafstand');
        $linkedIn = checkPost('linkedIn');
        $facebook = checkPost('facebook');
        $twitter = checkPost('twitter');
        $opmerking = checkPost('opmerking');
        
        $sql = mysqli_query($connection, "UPDATE `user` SET 
                        `telefoon` =   '".$telefoon."',
                        `voornaam` =   '".$voornaam."',
                        `tussenvoegsel` = '".$tussenvoegsel."',
                        `achternaam` = '".$achternaam."',
                        `straat` =     '".$straat."',
                        `huisnummer`=  '".$huisnummer."',
                        `toevoeging` = '".$toevoeging."',
                        `postcode` = '".$postcode."',
                        `geboortedatum` = '".$gebdat."',
                        `plaats` =     '".$woonplaats."',
                         `foto` = '".$foto."',  
                        `user_email` =      '".$email."',
                        `salaris` =     '".$salaris."',
                        `uitkering` =   '".$uitkering."',
                        `uitkering_geldig_tot` =  '".$uitkeringGeldigTot."',
                        `rijbewijs` =  '".$rijbewijs."',
                        `auto` =   '".$auto."',
                        `reisafstand` = '".$reisafstand."',
                        `opmerking` = '".$opmerking."',
                        `linkedin`= '".$linkedIn."',
                        `twitter`= '".$twitter."',
                        `facebook` =  '".$facebook."',
                        `cv` = '".$cv."'
                     
                         WHERE `user_id` = '".$user_id."'"); 

        if (mysqli_affected_rows($connection) == -1){
            echo mysqli_error($connection);
        }
};
 
 function checkPost($post){
     if (isset($_POST[$post])){
         $_SESSION[$post] = $_POST[$post];
         return $_POST[$post];
         
     }
     else {
         return $_SESSION[$post];
     }    
 };
    
 function verwerkFoto() {
     global $connection;

     // Check if image file is a actual image or fake image
    error_reporting(0);

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    error_reporting(E_ALL);
$uploadOk = 1;
    if ($uploadOk == 1) {
        $target_imgdir = "../../../assets/images/";// hier vindt de opslag plaats in de images map van de humanic(kandidaten) app
        $img_id = uniqid();
        $target_imgfile = $target_imgdir .basename($_FILES["foto"]["name"]);
        $imageFileType = pathinfo($target_imgfile,PATHINFO_EXTENSION);
        // Check if file already exists
        if ($_SESSION['foto']) {
            $_FILES["foto"]["name"] = $img_id. "." . $imageFileType;//  de foto krijgt een random nummer als naam           
            $target_imgfile = $target_imgdir .basename($_FILES["foto"]["name"]);
        }
        else {
            $_FILES["foto"]["name"] = $img_id. "." . $imageFileType;            
            $target_imgfile = $target_imgdir .basename($_FILES["foto"]["name"]);
        }   



    // Check file size
        if ($_FILES["foto"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    // Allow certain file formats
//echo "type '".$imageFileType."'";
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

    // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_imgfile)) {

                $_SESSION['foto'] = basename($_FILES["foto"]["name"]);
                //echo "foto '".$_SESSION['foto']."'";
                $sql = mysqli_query($connection, "UPDATE `user` SET `foto` = '".$_SESSION['foto']."'
                                                    WHERE `user_id` = '".$_SESSION['user_id']."'");
                if (mysqli_affected_rows($connection) == -1){
                  echo mysqli_error($connection);
                }
                //header("Refresh:0");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
 }

function verwerkCV ()
 {
        if(isSet($_POST["submit"]) && isSet($_FILES['cv']) && $_FILES['cv'] != "")// Testen op lege FILES variabelen schijnt niet te werken, ze blijken nl nooit 'leeg' te zijn!
             {
                     global $connection;
                    $uploadOk = 1;
    
                    $target_dir = "../../../assets/cv/";
                    $img_id = uniqid();

                    $target_file = $target_dir .basename($_FILES["cv"]["name"]);
                    $nwCvFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
                    //echo "de naam van de sessie cv: '".$_SESSION['cv']."'<br/>";
                    //echo "de naam van de nieuwe cv: '".$target_file."'<br/>";

                    $extensionPos = strripos($_SESSION['cv'], ".");// achterhaal op welke positie de punt voorkomt in de naam, tellen begint vanaf positie 0
                    //echo "de positie van de punt in de cv naam: '".$extensionPos."'<br/>";
    
                    $strLen = strlen($_SESSION['cv']);// de lengte van de cv bepalen
                    $cvFileType = substr($_SESSION['cv'], $extensionPos + 1, $strLen);//echo "cvFileType: '".$cvFileType."'<br/>";//het deel van de cv pakken vanaf de punt tot het eind van de cv
                    $strLenNwCvFileType = strlen($nwCvFileType);//echo "lengte van de neuwe extensie: '".$strLenNwCvFileType."'<br/>";
                    // Check if file already exists
                    if ($_SESSION['cv'] != ""  &&  $_FILES['cv'] !="")
                        {
                    //controle file type, niet gelijk dan file type vervangen
                                 if ($nwCvFileType != $cvFileType && $strLenNwCvFileType > 0)// als de extensie van de sessie cv verschilt van de extensie nieuw opgegeven cv en de extensie van de nieuwe cv groter is dan 0 tekens
                                     {
                                            $_FILES["cv"]["name"] = substr_replace($_SESSION['cv'],$nwCvFileType, $extensionPos + 1);//dan de naam van de sessei cv 
                                            $_SESSION['cv'] = $_FILES["cv"]["name"] ;// behouden en alleen de andere extensie aan plakken en dit weer toekennen aan de sessie cv
                                            //echo "extensie verschilt of er is geen nieuwe cv geupload: '".$_SESSION['cv']."'";
                                        }
                                else 
                                     {
                                        $_FILES["cv"]["name"] = $_SESSION['cv']; //echo "extensie hetzelfde: '".$_FILES["cv"]["name"]."'";
                                       }
                                $target_file = $target_dir .basename($_FILES["cv"]["name"]);
                        }
                    elseif ($_SESSION['cv'] != ""  &&  !isSet($_FILES['cv'])) 
                        {
                              $_FILES["cv"]["name"] = $_SESSION['cv'].$cvFileType; //echo "geen nieuwe cv geplaats, dus huidige is: '".$_FILES["cv"]["name"]."'";
                              $_SESSION['cv'] = $_FILES["cv"]["name"];
                        }
                    else
                        {
                                $_FILES["cv"]["name"] = $img_id . "." . $nwCvFileType;//echo "er was nog geen cv, nu wel: '".$_FILES["cv"]["name"]."'";
                                //$target_file = $target_dir .basename($_FILES["cv"]["name"]);
                        }
                        
                        $target_file = $target_dir .basename($_FILES["cv"]["name"]);

                    // Check file size
    if($_FILES["cv"]["size"] > 0)
            {
                    if ($_FILES["cv"]["size"] > 500000) 
                            {
                                echo "Sorry, your file is too large.";
                                $uploadOk = 0;
                            }
                    // Allow certain file formats

                     if($nwCvFileType != "doc" && $nwCvFileType != "docx" && $nwCvFileType != "txt" && $nwCvFileType != "pdf") 
                            {
                                  echo "Sorry, only DOC, DOCX, PDF and TXT files are allowed.";
                                  $uploadOk = 0;
                            }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                            {
                                echo "Sorry, your file was not uploaded.";
                            
                            } 
                    else // if everything is ok, try to upload file
                            {
                                    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) 
                                            {

                                                    $_SESSION['cv'] = basename($_FILES["cv"]["name"]);
                                                    $sql = mysqli_query($connection, "UPDATE `user` SET `cv` = '".$_SESSION['cv']."'
                                                    WHERE `user_id` = '".$_SESSION['user_id']."'");
                                                     if (mysqli_affected_rows($connection) == -1){
                                                    echo mysqli_error($connection);
                                                    }
            
                                               } 
                                    else 
                                            {
                                                    echo "Sorry, there was an error uploading your file.";
                                            }
                            } 
             }
        }
        
 }
