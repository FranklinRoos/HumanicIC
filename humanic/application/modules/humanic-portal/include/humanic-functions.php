<?php
function showPaswVergForm()// deze functie gebruik ik (nog) niet , is een test.
    {
        echo "<h1>Stel je wachtwoord opnieuw in</h1>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table>";
        echo "<tr><td>We hebben uw email-adres nodig om uw wachtwoord opnieuw in te stellen:</td>";
        echo "<td><input type='text' name='emailuser' value='email'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='submit' value='wachtwoord opnieuw instellen'>";
        echo "</form><br/>";

    }

 
/* @var $_POST type */
function handlePaswVergForm($email) // deze functie gebruik ik (nog) niet , is een test.
{
  global $connection;

// Als het gaat om bevestigen van het mailtje
if(getUseremail($email) === true)//het email-adres komt voor in de db
{
    $activatiecode = sqlsafe($_GET['code']);
    $select_code = "SELECT * FROM `user` WHERE `vergeetcode` = '".$activatiecode."'";
    $query_code = mysqli_query($connection, $select_code) or die (mysqli_error());
    $show_code = mysqli_fetch_assoc($query_code);

    if(mysqli_num_rows($query_code) == "0")
    {
        echo "<div style=\"color:red;\">U heeft een verkeerde activatiecode ingevuld, of uw heeft reeds een bevestiging gedaan!</div>";
    }
    else
    {
        // Email selecteren
        $res = mysqli_query($connection, "SELECT * FROM `user` WHERE `vergeetcode` = '".$activatiecode."'");
        $show = mysqli_fetch_assoc($res);
                    
        // Password maken
        $pass = randomcode(10);
                    
        // Melding geven
        echo "Er is een mail met een nieuw wachtwoord gestuurd.";
                    
        // Database updaten
        mysqli_query($connection, "UPDATE `user` SET `vergeetcode` = '', `user_wachtwoord` = '".md5($pass)."' WHERE `vergeetcode` = '".$activatiecode."'");
                                        
        // Mail versturen
        //$headers   = array();
        $eigen_naam = 'Humanic IC';
        $eigen_mail = 'frankieboy37@hotmail.com';
        $aan = $show['user_email'];
        $onderwerp = "Nieuw wachtwoord";
        $bericht = "Beste '".$show['user-inlognaam']."',<br /><br />Via de website http://humanicdevelopment.com/index.html#content5-12 heeft u een nieuw wachtwoord aangevraagd.<br /><br /><strong>U kunt nu inloggen met het wachtwoord:</strong> ".$pass."<br /><br />Met vriendelijke groet,<br /><br />".$eigen_naam;
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: ".$eigen_naam." <".$eigen_mail.">\r\n";
        //$headers[] = "X-Mailer: PHP/".phpversion();
        mail($aan, $onderwerp, $bericht, $headers); 
    }
}
else
{

    if(($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['vergeten'])) 
    {
        $que = mysqli_query($connection,"SELECT * FROM `".$ledentabel."` WHERE emailadres = '".sqlsafe($_POST['emailadres'])."'");
                    
        if(mysqli_num_rows($que) == 0)
        {
            echo "<p>Het ingevuld emailadres is niet geldig of staat niet in de database!</p>";
        }
        else
        {
            // Code
            $activatiecode = randomcode(10);
                        
            // Melding
            echo "<p>Er is een bevestigingsmail naar je e-mailadres gestuurd.</p>";
                    
            // Database updaten dus code inserten
            mysqli_query($connection, "UPDATE `".$ledentabel."` SET `vergeetcode` = '".$activatiecode."' WHERE `emailadres` = '".sqlsafe($_POST['emailadres'])."'");
                    
            // Mail versturen
            $aan = sqlsafe($_POST['emailadres']);
            $onderwerp = "Wachtwoord vergeten";
            $bericht = "Beste,<br /><br />Via de website ".$eigen_site." is aangegeven dat u uw wachtwoord vergeten bent.<br /><br />Wanneer dit het geval is, dient u op onderstaande link te klikken. Wanneer dit niet zo is, kunt u deze mail als niet verzonden beschouwen.<br /><br />Link: <a href=\"".$eigen_url."addons/wachtwoordvergeten.php?actie=bevestigen&code=".$activatiecode."\">".$eigen_url."addons/wachtwoordvergeten.php?actie=bevestigen&code=".$activatiecode."</a><br /><br />Met vriendelijke groet,<br /><br />".$eigen_naam;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
            $headers .= "From: ".$eigen_naam." <".$eigen_mail.">\r\n";
            mail($aan, $onderwerp, $bericht, $headers); 
        }
    }
    else
    {
        echo "<p>Vul hieronder uw emailadres in. Er zal een link naar je emailadres gestuurd worden. Wanneer u hier op klikt wordt er een nieuw wachtwoord aangemaakt.</p><br />";
        echo "<p><form method=\"post\" action=\"\">E-mailadres:&nbsp;&nbsp;<input type=\"text\" name=\"emailadres\" /><br /><br /><input type=\"submit\" name=\"vergeten\" value=\"Verstuur\" /></form></p>";                
    }
}
}   
    
function showForm()
    {
        echo "<section id=\"loginblok\">";
         echo "<h3>Inloggen</h3>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table id=\"login\">";
        echo "<tr><td>Geef uw login naam:</td>";
        echo "<td><input type='text' name='login'></td></tr>";
        echo "<tr><td>Geef uw wachtwoord:</td>";       
        echo "<td><input type='password' name='passwd'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='submit' value='Login'>";
        echo "</form><br/>";
        echo "<div class=\"reg\">";
             echo "Heeft u zich nog niet geregistreerd?<br/>";
            echo "Dat kan <a href=\"register.php\"><mark>hier.</mark></a><br/><br/>";
        echo "</div>";
        echo "</section>";
        //echo "<a href=\"nwPasw.php\">Bent u uw wachtwoord vergeten ?</a>";
    }


function handleForm()
    {
        global $connection;
        
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
        if ($_POST['login']!="")
        {   // vraag het correcte login op
           if ($_POST['passwd']!="")
            {   // vraag het correcte wachtwoord en de authorisatie op 
                
                $auth = getAuthorisatie(strtolower($_POST['login']));//de auhtorisatie wordt hier opgevraagd
                $correct_passwd = trim(getPassword($_POST['login']));//hier wordt het ww behorende bij de loginnaam opgevraagd
                if (md5(trim($_POST['passwd']))==trim($correct_passwd))//hier wordt het ww behorende bij de loginnaam vergeleken met het opgegeven ww
                  {
                      maakSessieVariabelen();
                       $sql2 = mysqli_query($connection,"SELECT * FROM `user` WHERE `user_inlognaam`='".$_POST["login"]."' AND `user_activ`='yes'");
                      
                        if (mysqli_num_rows($sql2)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysqli_fetch_assoc($sql2))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                         {
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
                             $_SESSION[' '] = $row[' '];
                             $_SESSION['laatsgezien'] = $laatsgezien;
                             $_SESSION['laatsgezienTijdstip'] = $laatsgezienTijdstip;
                           
                             $_SESSION['onlineIP'] = $_SERVER['REMOTE_ADDR'];
                             $userid = $row['user_id'];
                             $_SESSION["user_id"] = $userid;
                             $_SESSION["user_authorisatie"] = $auth;
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
                           window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/login.php\"
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
                    echo "<b>Het systeem kon u niet inloggen, probeer het nogmaals!</b><br>";
                    $_SESSION["tellerInloggen"]++;
                    if ($_SESSION["tellerInloggen"]<4)
                    {
                    showForm();
                    }
                    else 
                    {
                    echo "<b>Volgens geruchten mag u maar 3 keer inloggen!</b><br>";
                    }
                 }
            }
             else
            {  echo "<b>U moet wel een echt wachtwoord invullen!</b><br>";
                showForm();
            } 
        }   
         else
            {  
                echo "<b>U moet wel een naam en een wachtwoord invullen!</b><br>";
                showForm();
            } 
    }
  
function maakSessieVariabelen() 
{
        global $connection;

                     // Eerst gegevens uit de USER-Tabel halen 
                         $sql4 = mysqli_query($connection, "SELECT * FROM `user` WHERE `user_inlognaam`='".$_POST["login"]."' AND `user_activ`='yes'");
                      
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
                             $_SESSION['cv'] = $row['cv'];
                             $_SESSION['geb-datum'] = $row['geboortedatum'];
                             $_SESSION['salaris'] = $row['salaris'];
                             $_SESSION['uitkeringsoort'] = $row['uitkeringsoort'];
                             $_SESSION['uitkeringGeldigTot'] = $row['uitkering_geldig_tot'];
                             $_SESSION['bedrijf-grootte'] = $row['user_bedrijf_grootte'];
                             $_SESSION['rijbewijs'] = $row['user_rijbewijs'];
                             $_SESSION['reisafstand'] = $row['user_reisafstand'];
                         }
                    // Gegevens uit de SECTOR-Tabel halen 
                         $userid = $_SESSION["user_id"];
                    $sql5 = mysqli_query("SELECT * FROM `user_sector` WHERE `user_id`='".$userid."' ");
                      
                        if (mysqli_num_rows($sql4)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysqli_fetch_assoc($sql4))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                         {
                            if($row['sector_naam']=='ICT')
                             $_SESSION['werkbox1'] = '1';
                            
                            if($row['sector_naam']=='Zorg')
                             $_SESSION['werkbox2'] = '2';
                            
                            if($row['sector_naam']=='Industrie')
                             $_SESSION['werkbox3'] = '3';
                            
                            if($row['sector_naam']=='Retail')
                             $_SESSION['werkbox4'] = '4';

                         }     
           $sql6 = mysqli_query($connection, "SELECT * FROM `user_functie` WHERE `user_id`='".$userid."' ");
                      
                        if (mysqli_num_rows($sql4)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysqli_fetch_assoc($sql4))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                         {
                            if($row['functie_id']=='1')
                             $_SESSION['fbox'] = '1';
                            
                           if($row['functie_id']=='2')
                             $_SESSION['fbox'] = '2';
                            
                           if($row['functie_id']=='3')
                             $_SESSION['fbox'] = '3';
                            
                           if($row['functie_id']=='4')
                             $_SESSION['fbox'] = '4';
                           
                           if($row['functie_id']=='5')
                             $_SESSION['fbox'] = '5';
                           
                           if($row['functie_id']=='6')
                             $_SESSION['fbox'] = '6';
                           
                           if($row['functie_id']=='7')
                             $_SESSION['fbox'] = '7';
                           
                           if($row['functie_id']=='8')
                             $_SESSION['fbox'] = '8';
                           
                           if($row['functie_id']=='9')
                             $_SESSION['fbox'] = '9';
                           
                           if($row['functie_id']=='10')
                             $_SESSION['fbox'] = '10';
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
        echo "<tr><td>E-mailadres: </td>";
        echo "<td><input type='text' name='emailuser' value='".$email."'></td></tr>";
        echo "<tr><td>Typ uw wachtwoord:</td>";
        echo "<td><input type='password' name='regpasswd1'</td></tr>";
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
                  // controleer of er fouten zijn
       if($fout)
          {
                       // er zijn fouten
            // geef het lijstje van fouten
            echo "<UL><h4>";
            echo ($naam_fout?"<li>U heeft geen loginnaam ingevuld</li>":"");
            echo ($naamdouble_fout?"<li>Deze naam is al in gebruik</li>":"");
            echo ($email_fout?"<li><em>U heeft geen e-mailadres ingevuld</em></li>":"");
            echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":"");   
            echo ($emaildouble_fout?"<li><em>Dit email-adres wordt al gebruikt</em></li>":"");
            
            echo "</h4></UL>";            
            // Geef het formulier opnieuw
            ShowRegForm($_POST["reglogin"], $_POST['emailuser']);
            
            
               }
             else
                {
                   // er zijn geen fouten
                  echo "<h4 class=\"regdata\">Uw login gegevens:</h4><hr>";
                  echo"<table class=\"gegevens\">";
                  echo "<tr><td>Loginnaam:</td><td><h5> ".$_POST["reglogin"]."</h5></td></tr>";
                  echo "<tr><td>E-Mail:</td><td><h5> ".$_POST['emailuser']."</h5></td></tr>";
                  echo "</table>";
                  
                  $_SESSION['loginnaam']= ucfirst($_POST['reglogin']);    
                // controle op dezelfde wachtwoorden (typfoutencheck)
                if ($_POST['regpasswd1']==$_POST['regpasswd2'])
                {
                    $_SESSION['regpasswd']=$_POST['regpasswd1'];
                    $code=uniqid(); // deze moet je zelf ook hebben om op te kunnen controleren later 
                    $_SESSION['code'] = $code;
                    reglinkVerzenden ($_POST['emailuser'],$_POST['regpasswd1'],$_SESSION['code']);
                   //else //emailadres is correct
                       
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
                      /* echo "<div id=\"welkomPieter\">";
                       echo "<h3> U bent nu een stap verwijderd van registratie!<br>";
                       echo "Er is een email naar ".$_POST['emailuser']." verzonden met een activeringslink,<br> ";
                       echo "u kunt <a href=\"login.php\"> inloggen</a> nadat u hierop heeft geklikt,</h3></div>";
                       echo "";*/
                       echo "<h4 class=\"regdata\">";
                       echo "Nadat u bent ingelogd kunt u verder gaan met de registratie<br>";
                       echo "Er is een email verzonden naar  ".$_POST['emailuser']." met een activatie link,<br>";
                       echo "u kunt<a href=\"login.php\"> inloggen </a> nadat u hierop heeft geklikt.";
                       echo "</h4>";
                       /* echo "<script type=\"text/javascript\">
                    window.location = \"".$GLOBALS['path']."/application/modules/psinfoportal/verify.php\"
                    </script>";  */
                       
                       
                       
                     //  reglinkVerzenden($_POST['reglogin'],$_POST['regpasswd1'],$_POST['emailuser']);
                    //echo "U bent nu bij ons geregistreerd.<br/>";
                    //echo "U kunt <a href=\"login.php\"> hier </a> nu inloggen<br>"; 
                    }
                }    
                  
                   else
                    {  
                    echo "<b>De wachtwoorden komen niet overeen, probeer het nogmaals!</b><br>";
                    showRegForm();
                    }
               }
          } 
          else
              if ($_POST["reglogin"] == "")
              {
                  echo "<h4>U heeft geen loginnaam ingevuld</h4>";
                  showRegForm();
              }
              else
                {  
                  echo "<b>U moet wel een naam en 2x hetzelfde wachtwoord invullen!</b><br>";
                  showRegForm();
                } 
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
  $patroon = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]{2,}\.)+([a-z0-9_-]{2,})$/i";
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

$email="Uw Loginnaam: ".$_SESSION['loginnaam']."
Uw wachtwoord: ".$_SESSION['regpasswd']."
Klik op deze link: http://www.localhost:7777/humanic/application/modules/humanic/verify.php?acode=$code\ ,om u te kunnen verifieren";
$to = $regemail;
$from = 'frankieboy37@hotmail.com';

ini_set('sendmail_from', $from);

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: Humanic IC <{$from}>";
$headers[] = "Reply-To: Humanic IC <{$from}>";
//$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($to, $subject, $email, implode("\r\n", $headers) ); 
    
    
}

// function om het bestelformulier te laten zien
        
function showBestelForm($naam="", $adres="", $postcode="", $woonplaats="", $land="nederland", $telefoon="", $email="")//deze functie heb ik niet meer gebruikt
    {
        global $PHP_SELF;
        echo "<h1>Gratis bestelling van 'Please please me's number one'</h1>";
        echo "<h2>Vul hieronder uw persoonsgegevens in:</h2><br />";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post>";
        echo "<table class=\table\">";
        echo "<tr><td id=\"bestelL\">Naam: </td><td id=\"bestelR\"><input type='text' name='naam' value='$naam'></td></tr>";
        echo "<tr><td id=\"bestelL\">Adres: </td><td id=\"bestelR\"><input type='text' name='adres' value='$adres'></td></tr>";
        echo "<tr><td id=\"bestelL\">Postcode: </td><td id=\"bestelR\"><input type='text' name='postcode' value='$postcode'></td></tr>";
        echo "<tr><td id=\"bestelL\">Woonplaats: </td><td id=\"bestelR\"><input type='text' name='woonplaats' value='$woonplaats'></td></tr>";
        echo "<tr><td id=\"bestelL\">Land: </td><td id=\"bestelR\"><input type='text' name='land' value='$land'</td></tr>";
        echo "<tr><td id=\"bestelL\">Telefoonnr: </td><td id=\"bestelR\"><input type='text' name='telefoon' value='$telefoon'></td></tr>";
        echo "<tr><td id=\"bestelL\">E-mailadres: </td><td id=\"bestelR\"><input type='text' name='email' value='$email'></td></tr>";
        echo "<tr><td id=\"bestelL\">Aantal exemplaren(maximaal 4): </td><td id=\"contactR\">";
        echo "<input type='radio' name='aantal' value='1' checked='true' >1
         <input type='radio' name='aantal' value='2'>2
         <input type='radio' name='aantal' value='3'>3
         <input type='radio' name='aantal' value='4'>4<br /></td></tr>";
        echo "</table><br />"; 
        echo "<input type='submit' name='submit' value='Verzenden'><br /><br />";
        echo "</form>";
      }

function handleBestelForm()//deze functie heb ik niet meer gebruikt
 {  
        global $connection;

        $boek_id = "9";
        $boek_titel = "Please please me's number one";
        $email = $_POST['email'];
        $telefoon = $_POST["telefoon"]; 
        $naam = $_POST['naam'];
        $adres = $_POST["adres"];
        $postcode = $_POST["postcode"];
        $woonplaats = $_POST["woonplaats"];
        $land = $_POST['land'];
       
        // BK: Hoe gaat dit i.c.m. de lokale variabelen hierboven?
         global $naam;
            global $adres;
            global $postcode;
            global $woonplaats;
            global $telefoon;
            global $email;
            valid_naam($naam);
            valid_adres($adres);
            valid_postcode($postcode);
            valid_woonPlaats($woonplaats);
            valid_telefoon($telefoon);
    
        // handel het formulier af
        // Initialiseer fout variabelen
        $fout=FALSE;
        $naam_fout=FALSE;
        $adres_fout=FALSE;
        $postcode_fout=FALSE;
        $woonplaats_fout=FALSE;
        $telefoon_fout=FALSE;
        $email_fout=FALSE;
        $naamsyntax_fout=FALSE;
        $adressyntax_fout=FALSE;
        $postcodesyntax_fout=FALSE;
        $woonplaatssyntax_fout=FALSE;
        $telefoonsyntax_fout=FALSE;
        $emailsyntax_fout=FALSE;

        // controleer op lege velden en syntaxfouten
        if ($_POST["naam"] == "")
	{
	    $fout=TRUE;
	    $naam_fout=TRUE;
	}

	if ($_POST["adres"] == "")
	{
	    $fout=TRUE;
	    $adres_fout=TRUE;
	}
        if ($_POST["postcode"] == "")
	{
	    $fout=TRUE;
	    $postcode_fout=TRUE;
	}

	if ($_POST["woonplaats"] == "")
	{
	    $fout=TRUE;
	    $woonplaats_fout=TRUE;
	}
	if ($_POST["telefoon"] == "")
	{
	    $fout=TRUE;
	    $telefoon_fout=TRUE;
	}

	if ($_POST["email"] == "")
	{
	    $fout=TRUE;
	    $email_fout=TRUE;
	}

        if(!valid_naam($_POST["naam"]))
        {
            $fout=TRUE;
            $naamsyntax_fout=TRUE;
        }
        if(!valid_adres($_POST["adres"]))
        {
          $fout=TRUE;
          $adressyntax_fout=TRUE;
        }
        if(!valid_postcode($_POST["postcode"]))
        {
           $fout=TRUE;
           $postcodesyntax_fout=TRUE;
        }
        if(!valid_woonplaats($_POST["woonplaats"]))
        {
          $fout=TRUE;
          $woonplaats_fout_fout=TRUE;
        }
        if(!valid_telefoon($_POST["telefoon"]))
        {
          $fout=TRUE;
          $telefoonsyntax_fout=TRUE;
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
            echo "<UL>";
            echo ($naam_fout?"<li>U heeft geen naam ingevuld</li>":"");
            echo ($naamsyntax_fout?"<li>Deze naam is niet toegestaan</li>":"");
            echo ($adres_fout?"<li>U heeft geen adres ingevuld</li>":"");
            echo ($adressyntax_fout?"<li>Vul een geldig adres in</li>":"");
            echo ($postcode_fout?"<li>U heeft geen postcode ingevuld</li>":"");
            echo ($postcodesyntax_fout?"<li>Deze postcode bestaat niet</li>":"");
            echo ($woonplaats_fout?"<li>U heeft geen woonplaats ingevuld</li>":"");
            echo ($woonplaatssyntax_fout?"<li>Deze plaats bestaat niet</li>":"");
            echo ($telefoon_fout?"<li>U heeft geen telefoonnummer ingevuld</li>":"");
            echo ($telefoonsyntax_fout?"<li>Dit telefoon-nummer is niet correct</li>":"");
            echo ($email_fout?"<li>U heeft geen e-mailadres ingevuld</li>":"");
            echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":""); 
            echo "</UL>";            
            // Geef het formulier opnieuw
         showBestelForm($_POST["naam"], $_POST["adres"], $_POST["postcode"], $_POST["woonplaats"],$_POST['land'], $_POST["telefoon"], $_POST["email"]);

        } 
       
       else //Er zijn geen fouten,presenteer de gegevens  
       {
        
          $sql = mysqli_query($connection, "INSERT INTO bestelling (`boek_id`,`user_id`,`user_inlognaam`, `boek_titel`, `aantal`,
              `user_email`,`bestelling_naam`,`straatnaam`, `postcode`, `woonplaats`, `land`, `mobiel`)
              VALUES ('".$boek_id."', '".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$boek_titel."', '".$_POST['aantal']."',"
                  . " '".$_POST['email']."', '".$_POST['naam']."', '".$_POST['adres']."', '".$_POST['postcode']."',"
                  . " '".$_POST['woonplaats']."', '".$_POST['land']."','".$_POST['telefoon']."')");
                 if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                        
                     echo "<h3>Uw Bestelling is succesvol verstuurd,de afhandeling kan 2 weken duren !</h3>";
                     echo "<h4>Dit zijn uw Gegevens</h4><hr>";
                     echo "<table class=\table\"><h5>";
                     echo "<tr><td id=\"bestelL\">User-ID:</td><td id=\"bestelR\"> ".$_SESSION['user_id']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Inlognaam:</td><td id=\"bestelR\">".$_SESSION['loginnaam']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Naam:</td><td id=\"bestelR\"> ".$_POST["naam"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Adres:</td><td id=\"bestelR\"> ".$_POST["adres"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Postcode:</td><td id=\"bestelR\"> ".$_POST["postcode"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Woonplaats:</td><td id=\"bestelR\"> ".$_POST["woonplaats"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Land:</td><td id=\"bestelR\"> ".$_POST['land']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Telefoon:</td><td id=\"bestelR\"> ".$_POST["telefoon"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">E-Mail:</td><td id=\"bestelR\"> ".$_POST["email"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Boek-ID:</td><td id=\"bestelR\"> ".$boek_id."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Boek-titel:</td><td id=\"bestelR\"> ".$boek_titel."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Aantal besteld:</td><td id=\"bestelR\">".$_POST['aantal']."</td></tr>";
                     echo "</h5></table>";
                    }
       
     }
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
 
 function showKandidaatRegForm ($achternaam="", $tussenvoegsel="", $voornaam="", $email="", $straat="", $huisnr="", $toevoeging="", $postcode="", $woonplaats="", $gebdat="", $soortuitkering="") 
 { // formulier wordt door Sellahatin gemaakt
          // global $PHP_SELF;
       /* echo "<h2>Vul hieronder uw persoonsgegevens in:</h2><br />";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post>";
        echo "<table class=\table\">";
        echo "<tr><td id=\"naam\">Naam: </td><td id=\"naamR\"><input type='text' name='naam' value='$naam'></td></tr>";
        echo "<tr><td id=\"adres\">Adres: </td><td id=\"adresR\"><input type='text' name='adres' value='$adres'></td></tr>";
        echo "<tr><td id=\"postcode\">Postcode: </td><td id=\"postcodeR\"><input type='text' name='postcode' value='$postcode'></td></tr>";
        echo "<tr><td id=\"woonplaats\">Woonplaats: </td><td id=\"woonplaatsR\"><input type='text' name='woonplaats' value='$woonplaats'></td></tr>";
        echo "<tr><td id=\"land\">Land: </td><td id=\"landR\"><input type='text' name='land' value='$land'</td></tr>";
        echo "<tr><td id=\"telnr\">Telefoonnr: </td><td id=\"telnrR\"><input type='text' name='telefoon' value='$telefoon'></td></tr>";
        echo "<tr><td id=\"email\">E-mailadres: </td><td id=\"emailR\"><input type='text' name='email' value='$email'></td></tr>";
        echo "<tr><td id=\"bestelL\">Aantal exemplaren(maximaal 4): </td><td id=\"contactR\">";
        echo "<input type='radio' name='aantal' value='1' checked='true' >1
         <input type='radio' name='aantal' value='2'>2
         <input type='radio' name='aantal' value='3'>3
         <input type='radio' name='aantal' value='4'>4<br /></td></tr>";
        echo "</table><br />"; 
        echo "<input type='submit' name='submit' value='Verzenden'><br /><br />";
        echo "</form>"; */
     if(isSet($_SESSION['loginnaam']) && !isSet($_POST['submit']) ) {
                    $email = $_SESSION['email'];
        //$telefoon = $_SESSION["telefoon"]; 
        $achternaam = $_SESSION['achternaam'];
        $voornaam = $_SESSION['voornaam'];
        $tussenvoegsel = $_SESSION['tussenvoegsel'];
        $straat = $_SESSION["straat"];
        $huisnummer = $_SESSION['huisnummer'];
        $toevoeging = $_SESSION['toevoeging'];
        $postcode = $_SESSION["postcode"];
        $woonplaats = $_SESSION["plaats"];
        $gebdat = $_SESSION["geb-datum"];
        $soortuitkering = $_SESSION['uitkeringsoort'];
         }
      $loginnaam = $_SESSION['loginnaam'];     
  echo " <div class=\"container\">";
			echo "<h2>Registratie formulier</h2>";
			//<form id=\"fuikweb-register\" action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post  role=\"form\">
			//<form class="form-horizontal" role="form">
                                              echo "<form id=\"fuikweb-register\" action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post  role=\"form\">";
				echo "<section id=\"persoonlijke-gegevens\">";
							
						 echo "<section id=\"personalia\">";
							echo "<div class=\"kop\">";
								echo "<p>Vul je persoonlijke gegevens in, velden met een * zijn verplicht.</p>";
							echo "</div>";
	 					//	<h4>Personalia:</h4> -->
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3 text-left\" for=\"login-naam\">Loginnaam: ".$loginnaam." </label>";
								//<input type="text" class='form-control' id="login-naam" name="LoginNaam" required="required" autofocus="autofocus"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<Loginnaam : ".$loginnaam." autofocus=\"autofocus\"/>";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"achternaam\">Achternaam *</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"achternaam\" name=\"achterNaam\" value='$achternaam' required=\"required\"/>";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"tussenvoegsel\">Tussenvoegsel</label>";
								//<!-- <input type="email" class="form-control" id="tussenvoegsel" name="TussenVoegsel"/> -->
								echo "<div class=\"col-sm-2\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"tussenvoegsel\" name=\"tussenVoegsel\" value='$tussenvoegsel'/>";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3 text-left\" for=\"voornaam\">Voornaam *</label>";
								//<!-- <input type="text" class="form-control" id="voornaam" name="VoorNaam" required="required" pattern="[a-zA-Z0-9]{5,}" title="At least 5 letters and numbers"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"voornaam\" name=\"voorNaam\" value='$voornaam' required=\"required\"  />";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\>";
								echo "<label class=\" col-sm-3 text-left\"  for=\"voornaam\">Email *</label>";
								//<!-- <input type="text" class="form-control" id="voornaam" name="VoorNaam" required="required" pattern="[a-zA-Z0-9]{5,}" title="At least 5 letters and numbers"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"email\" class=\"form-control input-sm\" id=\"voornaam\" name=\"email\" value='$email' required=\"required\" pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$\" />";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3 col-offset-1\" for=\"straat\">Straat </label>";
								//<!-- <input type="text" class="form-control" id="straat" name="Straat" required="required"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"straat\" name=\"straat\" value='$straat' />";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"huisnummer\">Huisnummer</label>";
								//<!-- <input type="text" class="form-control" id="huisnummer" name="HuisNummer" placeholder="Huisnummer"/> -->
								echo "<div class=\"col-sm-2\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"huisnummer\" name=\"huisNummer\" value='huisnummer' >";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"toevoeging\">Toevoeging</label>";
								//<!-- <input type="text" class="form-control" id="huisnummer" name="HuisNummer" placeholder="Huisnummer"/> -->
								echo "<div class=\"col-sm-2\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"toevoeging\" name=\"toevoeging\"/ value='$toevoeging'>";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"postcode\">Postcode</label>";
								//<!-- <input type="text" class="form-control" id="postcode" name="PostCode" placeholder="1032CJ"/> -->
								echo "<div class=\"col-sm-3\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"postcode\" name=\"postCode\" value='$postcode' placeholder=\"1032CJ\"/>";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"plaats\">Plaats</label>";
								//<!-- <input type="text" class="form-control" id="plaats" name="Plaats" placeholder="Amsterdam"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"plaats\" name=\"plaats\" value='$woonplaats'/>";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"geboortedatum\">Geboortedatum</label>";
								//<!-- <input type="text" class="form-control" id="geboortedatum" name="GeboorteDatum" placeholder="dd-mm-jjjj"/> -->
								echo "<div class=\"col-sm-4\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"geboortedatum\" name=\"geboorteDatum\" value='$gebdat' placeholder=\"dd-mm-jjjj\"/>";
								echo "</div>";	
							echo "</div>";
						echo "</section>";
					
					echo "<section id=\"sociaal_foto\">";
						echo "<div id=\"foto\" class=\"form-group\">";
								echo "<label  for=\"foto\">Foto uploaden</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								//<!-- <div  class="col-sm-4 text-left"> -->
								echo "<div>";
									echo "<input class=\"form-control col-sm-4\" type=\"file\" class=\"form-control\" id=\"fototest\" name=\"foto\" placeholder=\"test\"/>";
									echo "<img class=\"col-sm-4\" id=\"myImg\" sc=\"#\" alt=\"your image\"/>";
								echo "</div>";
						echo "</div>";
						echo "<div id=\"cv\" class=\"form-group\">";
								echo "<label  for=\"cv\">CV uploaden</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								//<!-- <div  class="col-sm-4 text-left"> -->
								echo "<div>";
									echo "<input class=\"form-control col-sm-4\" type=\"file\" class=\"form-control\" id=\"fototest\" name=\"cv\" />";
									
								echo "</div>";
						echo "</div>";
						echo "<section id=\"sociale_media\">";
						echo "<div class=\"form-group\">";
								echo "<label class=\"control-label col-sm-2\" for=\"linkedin\">LinkedIn</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								echo "<div class=\"col-sm-10\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"linkedin\" name=\"linkedIn\" placeholder=\"linkedIn link\" />";
								echo "</div>";	
						echo "</div>";
						echo "<div class=\"form-group\">";
								echo "<label class=\"control-label col-sm-2\" for=\"facebook\">Facebook</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								echo "<div class=\"col-sm-10\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"facebook\" name=\"faceBook\" placeholder=\"facebook link\"/>";
								echo "</div>";	
						echo "</div>";
						echo "<div class=\"form-group\">";
								echo "<label class=\"control-label col-sm-2\" for=\"twitter\">Twitter</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								echo "<div class=\"col-sm-10\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"twitter\" name=\"twitter\" placeholder=\"twitter link\"/>";
								echo "</div>";	
						echo "</div>";
						echo "</section>";
					echo "</section>";	
					
				echo "</section>";	
									
				echo "<section id=\"functies\">";
						echo "<div class=\"kop\">";
							echo "<p>Vink de functie(s) aan waarin je geinteresseerd bent en geef je werkervaring aan in die functie";
						echo "</div>";
					
					
						echo "<div class=\"row\">";
							echo "<label class=\"col-sm-2 text-left\"><input id=\"functieCheck1\" type=\"checkbox\" value=\"\" name=\"fbox1\" > Java developer</label>";
							
							echo "<div  id=\"ervaringSlider1\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring1\" data-slider-id=\"ervaringSlider1\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"hide\"/>";		
								echo "<div>";
									echo "<span  id=\"ex1CurrentSliderValLabel\"> <span id=\"ex1SliderVal\">&nbsp 0</span></span>";
								echo "</div>";	
								
							echo "</div>";
							echo "<label class=\"col-sm-2 text-left\"><input id=\"functieCheck2\" type=\"checkbox\" value=\"\" name=\"fbox2\" > Functioneel ontwerper</label>";
							
								echo "<div id=\"ervaringSlider2\" class=\"ervaringSlider col-sm-2\">";
									echo "<input id=\"ervaring2\" data-slider-id=\"ervaringSlider2\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
									echo "<div >";
										echo "<span id=\"ex2CurrentSliderValLabel\"> <span id=\"ex2SliderVal\">0</span></span>";
									echo "</div>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>"; 
						echo "</div>";
						/*echo "<div class=\"row\">";
							echo "<label class=\"col-sm-3 text-left\"><input id=\"functieCheck2\" type=\"checkbox\" value=\"\" > Functioneel ontwerper</label>";
							
								echo "<div id=\"ervaringSlider2\" class=\"ervaringSlider col-sm-2\">";
									echo "<input id=\"ervaring2\" data-slider-id=\"ervaringSlider2\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
									echo "<div >";
										echo "<span id=\"ex2CurrentSliderValLabel\"> <span id=\"ex2SliderVal\">0</span></span>";
									echo "</div>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>"; 
								
							
						echo "</div>";*/
						echo "<div class=\"row\">";
							echo "<label class=\"divSlider col-sm-3 text-left\"><input id=\"functieCheck3\" type=\"checkbox\" value=\"\" name=\"fbox3\" > .NET developer</label>";
							echo "<div id=\"ervaringSlider3\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring3\" data-slider-id=\"ervaringSlider3\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
								
								echo "<div>";
									echo "<span id=\"ex3CurrentSliderValLabel\"> <span id=\"ex3SliderVal\">0</span></span>";
								echo "</div>";	
								//<!-- <input type="range" value= "5" min="0" max="10"> -->
							echo "</div>";
						echo "</div>";
						echo "<div class=\"row\">";
							echo "<label class=\"col-sm-3 text-left\"><input id=\"functieCheck4\" type=\"checkbox\" value=\"\" name=\"fbox4\" > Test Coordinator</label>";
							echo "<div  id=\"ervaringSlider4\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring4\" data-slider-id=\"ervaringSlider4\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";
								echo "<div>";
									echo "<span id=\"ex4CurrentSliderValLabel\"> <span id=\"ex4SliderVal\">0</span></span>";
								echo "</div>";	
								//<!-- <input type="range" value= "5" min="0" max="10"> -->
							echo "</div>";
						echo "</div>";
						echo "<div class=\"row\">";
							echo "<label class=\"col-sm-3 text-left\"><input id=\"functieCheck5\" type=\"checkbox\" value=\"\" name=\"fbox5\" > Front-end developer</label>";
							echo "<div id=\"ervaringSlider5\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring5\" data-slider-id=\"ervaringSlider5\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
								
								echo "<div>";
									echo "<span id=\"ex5CurrentSliderValLabel\"> <span id=\"ex5SliderVal\">0</span></span>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>";
							echo "</div>";
						echo "</div>";	 
						echo "<div class=\"row\">";
							echo "<label class=\"divSlider col-sm-3 text-left\"><input id=\"functieCheck6\" type=\"checkbox\" value=\"\" name=\"fbox6\" > Back-end developer</label>";
							echo "<div id=\"ervaringSlider6\" class=\"ervaringSlider col-sm-2\">";
								echo "<input  id=\"ervaring6\" data-slider-id=\"ervaringSlider6\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\"  tooltip=\"always\"/>";		
							
								echo "<div>";
									echo "<span id=\"ex6CurrentSliderValLabel\"> <span id=\"ex6SliderVal\">0</span></span>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>";
							echo "</div>";
						echo "</div>";	
							
				echo "</section>";
				
				echo "<section id=\"mobielFinUitkering\">";
					
					
					echo "<section id=\"mobielFinancieel\">";
						echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-5 text-left\"><input id=\"rijbewijsCheck\" type=\"checkbox\" value=\"\"  name=\"rijbewijs\" > Rijbewijs</label>";					
						echo "</div>";
						echo "<div class=\"form-group\" id=\"auto\">";
							echo "<label class=\"col-sm-5 text-left\"><input id=\"autoCheck\" type=\"checkbox\" value=\"\" > Auto</label>";					
						echo "</div>";
						echo "<div class=\"form-group\" id=\"financieel\">";
							echo "<label class=\"col-sm-5\" for=\"salaris\">Salaris indicatie</label>";
							echo "<div class=\"col-sm-5\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"salaris\" />";	
							echo "</div>";	
						echo "</div>";
						echo "<div class=\"form-group\" id=\"uitkering\">";
							echo "<label class=\"col-sm-5 \" for=\"uitkering\">Soort uitkering</label>";
							echo "<div class=\"col-sm-4\">";
								echo "<select class=\"form-control input-sm\" name=\"uitkering\" value='$soortuitkering'>";
									echo "<option value=\"WW\">WW</option>
									<option value=\"IOAW\">IOAW</option>
									<option value=\"Wajong\">Wajong</option>
									<option value=\"WAO\">WAO</option>";
							 echo "</select>";
							echo "</div>";	
						echo "</div>";
						echo "<div class=\"form-group\" id=\"ww\">";
							echo "<label class=\"col-sm-5\" for=\"salaris\">Uitkering geldig tot</label>";
							echo "<div class=\"col-sm-4\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"geldigTot\" placeholder=\"mm-jjjj\" />";
							echo "</div>";	
						echo "</div>";
					echo "</section>";	
					
					echo "<section id=\"sectorwerk\">";
						
						echo "<div id=\"sector\">";
							echo "<div class=\"kop\">";
								echo "<p>Vink de sector(s) aan waar je in werkzaam bent geweest</p>";
							echo "</div>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"  name=\"werbox1\">ICT";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"name=\"werbox2\">Zorg";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"name=\"werbox3\">Industrie";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"name=\"werbox4\">Retail";
							echo "</label>";
						echo "</div>";
						echo "<br><br><br>";
			
						/*echo "<div id=\"bedrijf\">";
							echo "<div class=\"kop\">";
								echo "<p>Gewenste grootte van het bedrijf (in aantal medewerkers)</p>";
							echo "</div>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">1-10";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">10-50";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">50-100";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">100-500";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">>500";
							echo "</label>";
						echo "</div>";*/
                                                                     
                                                                                           
                                                                                     echo "<div class=\"form-group\" id=\"uitkering\">";
							echo "<label class=\"col-sm-5 \" for=\"uitkering\">Gewenste grootte bedrijf:</label>";
							echo "<div class=\"col-sm-4\">";
								echo "<select class=\"form-control input-sm\" name=\"bedrijfgrootte\">";
									echo "<option value=\"1-10\">1-10</option>
									<option value=\"10-50\">10-50</option>
									<option value=\"50-100\">50-100</option>
									<option value=\">500\">>500</option>";
							 echo "</select>";
							echo "</div>";	
						echo "</div>";
                                                
                                                
                                                                                 
					echo "</section>";
				echo "</section>"; 
				
										
				echo "<section id=\"regio\">";
					echo "<div class=\"kop\">";
						echo "<p>Geef de maximale reisafstand en vink de gewenste regio's aan</p>";
					echo "</div>";	
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-1\" for=\"reisafstand\">Reisafstand</label>";
							//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
							echo "<div class=\"col-sm-2\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"reisafstand\" name=\"reisafstand\" placeholder=\"in km\" />";
							echo "</div>";

							/*echo "<label class=\"col-sm-1\" for=\"reisduur\">Reisduur</label>";
							//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
							echo "<div class=\"col-sm-2\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"reisduur\" name=\"reisduur\"  />";*/
							echo "</div>";							
					echo "</div>";	
					
					
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"noordholland\" value=\"\" > Noord-Holland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"limburg\" value=\"\" > Limburg";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"flevoland\" value=\"\" > Flevoland";
							echo "</label>";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"amsterdam\" value=\"\" > Amsterdam";
							echo "</label>";
					echo "</div>";
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"zuidholland\" value=\"\" > Zuid-Holland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"gelderland\" value=\"\" > Gelderland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"drenthe\" value=\"\" > Drenthe";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"rotterdam\" value=\"\" > Rotterdam";
							echo "</label>";
					echo "</div>";
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"zeeland\" value=\"\" > Zeeland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"overijssel\" value=\"\" > Overijssel";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"friesland\" value=\"\" > Friesland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"eindhoven\" value=\"\" > Eindhoven";
							echo "</label>";
					echo "</div>";
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"noordbrabant\" value=\"\" > Noord-Brabant";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"utrecht\" value=\"\" > Utrecht";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"groningen\" value=\"\" > Groningen";
							echo "</label>";
														
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"nijmegen\" value=\"\" > Nijmegen";
							echo "</label>";
					echo "</div>";	
				echo "</section>";
				
				
				echo "<section id=\"opmerkingSection\">";
					echo "<div class=\"kop\">";
						echo "<p>Opmerkingen</p>";
					echo "</div>";	
					echo "<div class=\"col-sm-6\">";
						echo "<textarea class=\"form-control\"  name=\"opmerkingen\" rows=\"5\">	</textarea>";									 
					echo "</div>";	
					echo "<br>";
				echo "</section>";
				
				echo "<section id=\"opslaan\">";
					echo "<br><br>";
					echo "<div class=\"text-right\">";
						echo "<div class=\"col-sm-12\">";
                                                                                                                  echo "<input type='submit' name='submit' value='Verzenden'><br /><br />";
							//echo "<button class=\"btn btn-primary btn-md\" type=\"button\" name=\"opslaan\" >Verzenden</button>";
							echo "<button class=\"btn btn-primary btn-md\" type=\"button\" name=\"wissen\">Wissen</button>";
						echo "</div>";	
				echo "</section>";
			echo "</form>";
		echo "</div>";
			
		//echo "<footer>";
		//echo "</footer>";
 /*    echo "<script src=\"http://code.jquery.com/jquery-1.11.0.min.js\" type=\"text/javascript\"></script>
        <script src=\"http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js\"></script>
        <script src=\"js/bootstrap-slider.js\" type=\"text/javascript\"></script>
		<script src=\"js/fuik.js\" type=\"text/javascript\"></script>		
		<script src=\"js/slider.js\" type=\"text/javascript\"></script>";
                
     echo "<script type=\"text/javascript\">
         <!---
				$("#file").change(function () {
					if (this.files && this.files[0])
                                                                                      {
						var reader = new FileReader();
						reader.onload = imageIsLoaded;
						reader.readAsDataURL(this.files[0]);
					        }
				});
		
			
	`		function imageIsLoaded(e) {
				$('#myImg').attr('src', e.target.result);
			};
		
       --->
              
              </script> "; */
     
     
     
 
}

 
 function handleKandidaatRegForm () 
 {
        global $connection;
        
        $email = $_POST['email'];
        //$telefoon = $_POST["telefoon"]; 
        $achternaam = $_POST['achterNaam'];
        $voornaam = $_POST['voorNaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $straat = $_POST["straat"];
        $huisnummer = $_POST['huisNummer'];
        $toevoeging = $_POST['toevoeging'];
        $postcode = $_POST["postCode"];
        $woonplaats = $_POST["plaats"];
        $gebdat = $_POST["geboorteDatum"];
        //$land = $_POST['land'];
       
         global $naam;
            global $adres;
            global $postcode;
            global $woonplaats;
            global $telefoon;
            global $email;
            valid_naam($naam);
            valid_adres($adres);
            valid_postcode($postcode);
            valid_woonPlaats($woonplaats);
            valid_telefoon($telefoon);
    
        // handel het formulier af
        // Initialiseer fout variabelen
        $fout=FALSE;
        $naam_fout=FALSE;
        $adres_fout=FALSE;
        $postcode_fout=FALSE;
        $woonplaats_fout=FALSE;
        $telefoon_fout=FALSE;
        $email_fout=FALSE;
        $naamsyntax_fout=FALSE;
        $adressyntax_fout=FALSE;
        $postcodesyntax_fout=FALSE;
        $woonplaatssyntax_fout=FALSE;
        $telefoonsyntax_fout=FALSE;
        $emailsyntax_fout=FALSE;

        // controleer op lege velden en syntaxfouten
        if ($_POST["naam"] == "")
	{
	    $fout=TRUE;
	    $naam_fout=TRUE;
	}

	if ($_POST["adres"] == "")
	{
	    $fout=TRUE;
	    $adres_fout=TRUE;
	}
        if ($_POST["postcode"] == "")
	{
	    $fout=TRUE;
	    $postcode_fout=TRUE;
	}

	if ($_POST["woonplaats"] == "")
	{
	    $fout=TRUE;
	    $woonplaats_fout=TRUE;
	}
	if ($_POST["telefoon"] == "")
	{
	    $fout=TRUE;
	    $telefoon_fout=TRUE;
	}

	if ($_POST["email"] == "")
	{
	    $fout=TRUE;
	    $email_fout=TRUE;
	}

        if(!valid_naam($_POST["naam"]))
        {
            $fout=TRUE;
            $naamsyntax_fout=TRUE;
        }
        if(!valid_adres($_POST["adres"]))
        {
          $fout=TRUE;
          $adressyntax_fout=TRUE;
        }
        if(!valid_postcode($_POST["postcode"]))
        {
           $fout=TRUE;
           $postcodesyntax_fout=TRUE;
        }
        if(!valid_woonplaats($_POST["woonplaats"]))
        {
          $fout=TRUE;
          $woonplaats_fout_fout=TRUE;
        }
        if(!valid_telefoon($_POST["telefoon"]))
        {
          $fout=TRUE;
          $telefoonsyntax_fout=TRUE;
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
            echo "<UL>";
            echo ($naam_fout?"<li>U heeft geen naam ingevuld</li>":"");
            echo ($naamsyntax_fout?"<li>Deze naam is niet toegestaan</li>":"");
            echo ($adres_fout?"<li>U heeft geen adres ingevuld</li>":"");
            echo ($adressyntax_fout?"<li>Vul een geldig adres in</li>":"");
            echo ($postcode_fout?"<li>U heeft geen postcode ingevuld</li>":"");
            echo ($postcodesyntax_fout?"<li>Deze postcode bestaat niet</li>":"");
            echo ($woonplaats_fout?"<li>U heeft geen woonplaats ingevuld</li>":"");
            echo ($woonplaatssyntax_fout?"<li>Deze plaats bestaat niet</li>":"");
            echo ($telefoon_fout?"<li>U heeft geen telefoonnummer ingevuld</li>":"");
            echo ($telefoonsyntax_fout?"<li>Dit telefoon-nummer is niet correct</li>":"");
            echo ($email_fout?"<li>U heeft geen e-mailadres ingevuld</li>":"");
            echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":""); 
            echo "</UL>";            
            // Geef het formulier opnieuw
        // showBestelForm($_POST["naam"], $_POST["adres"], $_POST["postcode"], $_POST["woonplaats"],$_POST['land'], $_POST["telefoon"], $_POST["email"]);

        } 
       
      /* else //Er zijn geen fouten,presenteer de gegevens  
       {
        
          $sql = mysqli_query($connection, "INSERT INTO bestelling (`boek_id`,`user_id`,`user_inlognaam`, `boek_titel`, `aantal`,
              `user_email`,`bestelling_naam`,`straatnaam`, `postcode`, `woonplaats`, `land`, `mobiel`)
              VALUES ('".$boek_id."', '".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$boek_titel."', '".$_POST['aantal']."',"
                  . " '".$_POST['email']."', '".$_POST['naam']."', '".$_POST['adres']."', '".$_POST['postcode']."',"
                  . " '".$_POST['woonplaats']."', '".$_POST['land']."','".$_POST['telefoon']."')");
                 if (mysqli_affected_rows()==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                        
                     echo "<h3>Uw Bestelling is succesvol verstuurd,de afhandeling kan 2 weken duren !</h3>";
                     echo "<h4>Dit zijn uw Gegevens</h4><hr>";
                     echo "<table class=\table\"><h5>";
                     echo "<tr><td id=\"bestelL\">User-ID:</td><td id=\"bestelR\"> ".$_SESSION['user_id']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Inlognaam:</td><td id=\"bestelR\">".$_SESSION['loginnaam']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Naam:</td><td id=\"bestelR\"> ".$_POST["naam"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Adres:</td><td id=\"bestelR\"> ".$_POST["adres"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Postcode:</td><td id=\"bestelR\"> ".$_POST["postcode"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Woonplaats:</td><td id=\"bestelR\"> ".$_POST["woonplaats"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Land:</td><td id=\"bestelR\"> ".$_POST['land']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Telefoon:</td><td id=\"bestelR\"> ".$_POST["telefoon"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">E-Mail:</td><td id=\"bestelR\"> ".$_POST["email"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Boek-ID:</td><td id=\"bestelR\"> ".$boek_id."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Boek-titel:</td><td id=\"bestelR\"> ".$boek_titel."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Aantal besteld:</td><td id=\"bestelR\">".$_POST['aantal']."</td></tr>";
                     echo "</h5></table>";
                    }
       
     }*/
     
     
 }