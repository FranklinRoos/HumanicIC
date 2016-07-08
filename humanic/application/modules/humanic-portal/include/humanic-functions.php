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
// Als het gaat om bevestigen van het mailtje
if(getUseremail($email) === true)//het email-adres komt voor in de db
{
    $activatiecode = sqlsafe($_GET['code']);
    $select_code = "SELECT * FROM `user` WHERE `vergeetcode` = '".$activatiecode."'";
    $query_code = mysql_query($select_code) or die (mysql_error());
    $show_code = mysql_fetch_assoc($query_code);

    if(mysql_num_rows($query_code) == "0")
    {
        echo "<div style=\"color:red;\">U heeft een verkeerde activatiecode ingevuld, of uw heeft reeds een bevestiging gedaan!</div>";
    }
    else
    {
        // Email selecteren
        $res = mysql_query("SELECT * FROM `user` WHERE `vergeetcode` = '".$activatiecode."'");
        $show = mysql_fetch_assoc($res);
                    
        // Password maken
        $pass = randomcode(10);
                    
        // Melding geven
        echo "Er is een mail met een nieuw wachtwoord gestuurd.";
                    
        // Database updaten
        mysql_query("UPDATE `user` SET `vergeetcode` = '', `user_wachtwoord` = '".md5($pass)."' WHERE `vergeetcode` = '".$activatiecode."'");
                                        
        // Mail versturen
        //$headers   = array();
        $eigen_naam = 'Humanic IC';
        $eigen_mail = 'frankieboy37@hotmail.com';
        $aan = $show['user_email'];
        $onderwerp = "Nieuw wachtwoord";
        $bericht = "Beste '".$show['user-inlognaam']."',<br /><br />Via de website www.pieterspierenburg.com heeft u een nieuw wachtwoord aangevraagd.<br /><br /><strong>U kunt nu inloggen met het wachtwoord:</strong> ".$pass."<br /><br />Met vriendelijke groet,<br /><br />".$eigen_naam;
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
        $que = mysql_query("SELECT * FROM `".$ledentabel."` WHERE emailadres = '".sqlsafe($_POST['emailadres'])."'");
                    
        if(mysql_num_rows($que) == 0)
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
            mysql_query("UPDATE `".$ledentabel."` SET `vergeetcode` = '".$activatiecode."' WHERE `emailadres` = '".sqlsafe($_POST['emailadres'])."'");
                    
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
        //echo "<h1 class=\"login\">Login</h1>";
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
        //echo "<a href=\"nwPasw.php\">Bent u uw wachtwoord vergeten ?</a>";
    }


function handleForm()
    {
        
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
                       $sql2 = mysql_query("SELECT * FROM `user` WHERE `user_inlognaam`='".$_POST["login"]."' AND `user_activ`='yes'");
                      
                        if (mysql_num_rows($sql2)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysql_fetch_assoc($sql2))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
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
                               $sql3 = mysql_query("UPDATE `user` SET
		                         `user_online` = 'y', `datum_gezien` = '".$_SESSION['current_date']."', `tijdstip_gezien`= '".$_SESSION['current_tijdstip']."'                      
		                         WHERE `user_id` = '".$_SESSION["user_id"]."'")
		                         or die(mysql_error());
                                      $useronline = $row['user_online'];
                                      $_SESSION['useronline'] = $useronline;
                             
            
                             //onlineLog();//Met deze functie(in application/modules/psinfoportal/include/onlineFunctions.php) 
                                           //de tabel 'online' in de database updaten
                             
                           //Terug naar het logon.php script  
                           echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/login.php\"
                           </script>";    
              
                        $sql = mysql_query("SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId and `page_show` ='y'");
                        echo "<div class=\"container\">";
                       if (mysql_num_rows($sql)==0)   
                          {
                            die ("Je hebt geen gegevens tot je beschikking");
                           }
                           while ($content = mysql_fetch_assoc($sql)) 
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
    
function getAuthorisatie($usernaam)    
{
      $auth = "usr";
      $sql = mysql_query("SELECT * FROM `user`");
      if (mysql_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysql_fetch_assoc($sql)) 
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
        $pass = "";
        $sql = mysql_query("SELECT * FROM `user`");
        if (mysql_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysql_fetch_assoc($sql)) 
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
        //echo "<h1>Registreren</h1>";
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
    }   
    
function handleAanmeldForm()
    {
      
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
                    
                    $sql = mysql_query("INSERT INTO user (`user_inlognaam`, `user_wachtwoord`,`user_email`,`activ_code`)
                        VALUES ('".$_POST['reglogin']."', '".md5($_POST['regpasswd1'])."', '".$_POST['emailuser']."', '".$_SESSION['code']."')");
                    if (mysql_affected_rows()==0)
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
        $usrdouble = false;
        $sql = mysql_query("SELECT * FROM `user`");
        if (mysql_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysql_fetch_assoc($sql)) 
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
  If(isSet($_SESSION['user_id']))
  {    
  $sql = mysql_query("UPDATE `user` SET `user_online`='n' WHERE `user_id` = ".$_SESSION['user_id']." ") or die(mysql_error());
  }
   // Unset all of the session variables.
  $_SESSION = array();
  session_destroy();        
              
}



function getUseremail($useremail) //controle op dubbele loginnaam
    {
        $emaildouble = false;
        $sql = mysql_query("SELECT * FROM `user`");
        if (mysql_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysql_fetch_assoc($sql)) 
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
        $boek_id = "9";
        $boek_titel = "Please please me's number one";
        $email = $_POST['email'];
        $telefoon = $_POST["telefoon"]; 
        $naam = $_POST['naam'];
        $adres = $_POST["adres"];
        $postcode = $_POST["postcode"];
        $woonplaats = $_POST["woonplaats"];
        $land = $_POST['land'];
       
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
        
          $sql = mysql_query("INSERT INTO bestelling (`boek_id`,`user_id`,`user_inlognaam`, `boek_titel`, `aantal`,
              `user_email`,`bestelling_naam`,`straatnaam`, `postcode`, `woonplaats`, `land`, `mobiel`)
              VALUES ('".$boek_id."', '".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$boek_titel."', '".$_POST['aantal']."',"
                  . " '".$_POST['email']."', '".$_POST['naam']."', '".$_POST['adres']."', '".$_POST['postcode']."',"
                  . " '".$_POST['woonplaats']."', '".$_POST['land']."','".$_POST['telefoon']."')");
                 if (mysql_affected_rows()==0)
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
          $sql = mysql_query("INSERT INTO contact (`user_id`,`user_inlognaam`, `contact_naam`,`contact_email`,`contact_subject`,`contact_bericht`)
              VALUES ('".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$_POST['naam']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['bericht']."')");
                 if (mysql_affected_rows()==0)
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
                   $sql = mysql_query("INSERT INTO contact (`contact_naam`,`contact_email`,`contact_subject`,`contact_bericht`)
              VALUES ('".$_POST['naam']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['bericht']."')");
                 if (mysql_affected_rows()==0)
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
 
 function showKandidaatRegForm ($naam="", $adres="", $postcode="", $woonplaats="", $land="nederland", $telefoon="", $email="") 
 { // formulier wordt door Sellahatin gemaakt
          // global $PHP_SELF;
        echo "<h2>Vul hieronder uw persoonsgegevens in:</h2><br />";
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
        echo "</form>"; 
     
     
     
     
     
 }
 
 
 function handleKandidaatRegForm () 
 {
           $boek_id = "9";
        $boek_titel = "Please please me's number one";
        $email = $_POST['email'];
        $telefoon = $_POST["telefoon"]; 
        $naam = $_POST['naam'];
        $adres = $_POST["adres"];
        $postcode = $_POST["postcode"];
        $woonplaats = $_POST["woonplaats"];
        $land = $_POST['land'];
       
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
        
          $sql = mysql_query("INSERT INTO bestelling (`boek_id`,`user_id`,`user_inlognaam`, `boek_titel`, `aantal`,
              `user_email`,`bestelling_naam`,`straatnaam`, `postcode`, `woonplaats`, `land`, `mobiel`)
              VALUES ('".$boek_id."', '".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$boek_titel."', '".$_POST['aantal']."',"
                  . " '".$_POST['email']."', '".$_POST['naam']."', '".$_POST['adres']."', '".$_POST['postcode']."',"
                  . " '".$_POST['woonplaats']."', '".$_POST['land']."','".$_POST['telefoon']."')");
                 if (mysql_affected_rows()==0)
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