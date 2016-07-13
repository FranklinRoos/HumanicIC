<?php

function overzicht()
{
    $user_id = $_SESSION["user_id"];//deze sessie variabele werd in de handleForm functie aangemaakt in humanic-functions.php
    $objecten = mysql_query("SELECT * FROM user where user_id=$user_id ") or die(mysql_error());// ik doe hier een call(query) naar de databse  in de 'user'tabel, voor 1 user
    
    if (mysql_num_rows($objecten) == 0) 
    {
        die("<i>Nog geen users aanwezig !</i>");
    }

        $GLOBALS['path']="http://localhost:7777/humanic/";
        global $path;        
        //vrijdag 8 juli 2016 toegevoegd
        echo "<h3 class=\"data-overzicht\"> ".$_SESSION["loginnaam"].", dit is een overzicht van je gegevens</h3>";// css in style.css vanaf r433
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tbody>";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"50\" align=\"left\">Pasfoto</th>";
        echo "<th width=\"50\" align=\"left\">Geregistreerd sinds</th>";        
        echo "<th width=\"50\" align=\"left\">Achternaam</th>";
        echo "<th width=\"50\" align=\"left\">Tussenvoegsel</th>";
        echo "<th width=\"50\" align=\"left\">Voornaam</th>";
        echo "<th width=\"50\" align=\"left\">Straat</th>";
        echo "<th width=\"50\" align=\"left\">Huisnummer</th>";
        echo "<th width=\"50\" align=\"left\">Postcode</th>";
        echo "<th width=\"50\" align=\"left\">Plaats</th>";
        echo "<th width=\"50\" align=\"left\">Telefoon</th>";
        echo "<th width=\"50\" align=\"left\">Geb.Datum</th>";
        echo "<th width=\"50\" align=\"left\">Salaris Indicatie</th>";
        echo "<th width=\"50\" align=\"left\">WW-geldig-tot</th>";
        echo "<th width=\"50\" align=\"left\">Sector-afkomstig</th>";
        echo "<th width=\"50\" align=\"left\">Bedrijf-grootte</th>";
        echo "<th width=\"50\" align=\"left\">Rijbewijs</th>";
        echo "<th width=\"50\" align=\"left\">Auto</th>";
        
        
        echo "</tr>";

	while ($bericht = mysql_fetch_object($objecten)) 
        {
            $imagepath=$GLOBALS['path']."assets/images/";
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?user_id=".$bericht->user_id."\">edit</a></td>";
            echo "<td>".utf8_encode("<img width=\"60\" height=\"60\" style=\"margin: 5px;\" src=\"$imagepath").utf8_encode($bericht->foto).".jpg\" /></td>";
            echo "<td>".utf8_encode($bericht->user_sinds)."</td>";
            echo "<td>".utf8_encode($bericht->achternaam)."</td>";
            echo "<td>".utf8_encode($bericht->tussenvoegsel)."</td>";
            echo "<td>".utf8_encode($bericht->voornaam)."</td>";
            echo "<td>".utf8_encode($bericht->straat)."</td>";
            echo "<td>".utf8_encode($bericht->huisnummer)."</td>";
            echo "<td>".utf8_encode($bericht->postcode)."</td>";
            echo "<td>".utf8_encode($bericht->plaats)."</td>";
            echo "<td>".utf8_encode($bericht->telefoon)."</td>";
            echo "<td>".utf8_encode($bericht->geboortedatum)."</td>";
            echo "<td>".utf8_encode($bericht->salaris)."</td>";
            echo "<td>".utf8_encode($bericht->uitkering_geldig_tot)."</td>";
            echo "<td>".utf8_encode($bericht->user_sector)."</td>";
            echo "<td>".utf8_encode($bericht->user_bedrijf_grootte)."</td>";
            echo "<td>".utf8_encode($bericht->user_rijbewijs)."</td>";
            echo "<td>".utf8_encode($bericht->user_auto)."</td>";
            
            
            echo "</tr>";
        }

        echo "</table>";
        echo "<table>";
        echo "<tr><td colspan='3'></td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";    
        
        
        
        
        
        
        
}
function userBewerken()
{
   /* if (!isset($_GET['user_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }*/
    
    $user_id = $_SESSION['user_id'];
    //$bericht = mysql_query("SELECT * FROM user WHERE user_id = ".$_GET['user_id']." LIMIT 1") or die(mysql_error());
    $bericht = mysql_query("SELECT * FROM user WHERE user_id = ".$user_id." LIMIT 1") or die(mysql_error());
    if (mysql_num_rows($bericht) == 0)
    {
        die("Deze user bestaat niet !");
    }
    $bericht = mysql_fetch_object($bericht);
    echo "<section id=\"section-bewerk\">";// de css voor deze tabel is in styles.css vanaf regel 408
    //echo "<h4 class=\"wijzig\">Wijzigen van user:</h4> <a class=\"edit\">".utf8_encode($bericht->user_inlognaam)."</a> met ID: <a class=\"edit\">".($bericht->user_id)."</a><br /><br />";
    echo "<div id=\"bewerk1\"><h4 style=\"text-align:center; color:#ffcc00;\">Hier kunt u uw gegevens wijzigen</h4><hr/></div><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table id=\"table-bewerk\" width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td class=\"bewerk\" width=\"150\">User inlognaam:</td>";
    //echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->usr_inlognaam)."\" size=\"50\" name=\"usr_inlognaam\" /></td></tr>";
    echo "<td class=\"bewerk\">".utf8_encode($bericht->user_inlognaam)."</td></tr>";
    echo "<tr><td></td>";
    echo "<tr><td class=\"bewerk\" class=\"bewerk\" width=\"150\">Rijbewijs:</td>";
        echo "<td><input type=\"radio\" name=\"user_rijbewijs\"";
    $waarde="nee";
    echo "value=$waarde ".(($bericht->user_rijbewijs==$waarde)?"checked":"")."> $waarde ";
    echo "<input type=\"radio\" name=\"user_rijbewijs\"";
    $waarde="ja";
    echo "value=$waarde ".(($bericht->user_rijbewijs==$waarde)?"checked":"")."> $waarde ";
    echo "</td></tr>";
    echo "<tr><td class=\"bewerk\" width=\"150\">Auto:</td>";
    echo "<td><input type=\"radio\" name=\"user_auto\"";
    $waarde="nee";
    echo "value=$waarde ".(($bericht->user_auto==$waarde)?"checked":"")."> $waarde ";
    echo "<input type=\"radio\" name=\"user_auto\"";
    $waarde="ja";
    echo "value=$waarde ".(($bericht->user_auto==$waarde)?"checked":"")."> $waarde ";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Straat:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->straat)."\" size=\"50\" name=\"straat\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->straat)."</td></tr>";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Huisnummer:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->huisnummer)."\" size=\"50\" name=\"huisnummer\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->huisnummer)."</td></tr>";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Postcode:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->postcode)."\" size=\"50\" name=\"postcode\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->postcode)."</td></tr>";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Plaats:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->plaats)."\" size=\"50\" name=\"plaats\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->plaats)."</td></tr>";
    
     echo "<tr><td class=\"bewerk\" width=\"150\">Telefoon:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->telefoon)."\" size=\"50\" name=\"telefoon\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->telefoon)."</td></tr>";
            
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"user_id\" value=\"".$bericht->user_id."\" />";
    echo "<input type=\"submit\" name=\"submit_edit_item\" value=\" Opslaan !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
    echo "</section>";
}

function userBewerktOpslaan()
{   
    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");
    
    $user_rijbewijs=(trim($_POST['user_rijbewijs']));
    $user_rijbewijs=str_replace($zoek, $maakentity, $user_rijbewijs);
    $user_auto=(trim($_POST['user_auto']));          
    $user_auto = str_replace($zoek, $maakentity, $user_auto);
    $straat = (trim($_POST['straat'])); 
    $straat = str_replace($zoek, $maakentity, $straat);
    $huisnummer = (trim($_POST['huisnummer'])); 
    $huisnummer = str_replace($zoek, $maakentity, $huisnummer);
    $postcode = (trim($_POST['postcode'])); 
    $postcode = str_replace($zoek, $maakentity, $postcode);
    $plaats = (trim($_POST['plaats'])); 
    $plaats = str_replace($zoek, $maakentity, $plaats);
    $telefoon = (trim($_POST['telefoon'])); 
    $telefoon = str_replace($zoek, $maakentity, $telefoon);

    if (isset($_POST['submit_edit_item']))
    {
        mysql_query("UPDATE `user` SET `user_id` ='".$_POST['user_id']."', `user_rijbewijs` ='".$user_rijbewijs."', `user_auto`= '".$user_auto."',  `straat`= '".$straat."' "
                . " ,`huisnummer` = '".$huisnummer."', `postcode`= '".$postcode."', `plaats`= '".$plaats."',"
                . "`telefoon`= '".$telefoon."'  WHERE `user_id` = ".$_POST['user_id']." ") or die(mysql_error());
    }
    $result_id=$_POST['user_id'];
    show_tekst($result_id);
    echo "</div>";
}

function show_tekst($result_id)
{
    $result_sql = mysql_query("SELECT * FROM user WHERE user_id=".$result_id."");
    while($q=mysql_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".$_SERVER['PHP_SELF']."?user_id=".$q['user_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">"; // width=\"90%\">";
        echo "<tr><th>User inlognaam:&nbsp;</th><td class=\"kleur\">".$q['user_inlognaam']."</td></tr>";
        //echo "<tr><th>User wachtwoord:&nbsp;</th><td class=\"kleur\">".$q['user_wachtwoord']."</td></tr>";
        echo "<tr><th>Rijbewijs:&nbsp;</th><td class=\"kleur\">".$q['user_rijbewijs']."</td></tr>";
        echo "<tr><th>Auto bezit:&nbsp;</th><td class=\"kleur\">".$q['user_auto']."</td></tr>";
        echo "<tr><th>Straat:&nbsp;</th><td class=\"kluer\">".$q['straat']."</td></tr>";
        echo "<tr><th>Huisnummer:&nbsp;</th><td class=\"kluer\">".$q['huisnummer']."</td></tr>";
        echo "<tr><th>Postcode:&nbsp;</th><td class=\"kluer\">".$q['postcode']."</td></tr>";
        echo "<tr><th>Plaats:&nbsp;</th><td class=\"kluer\">".$q['plaats']."</td></tr>";
        echo "<tr><th>Telefoon:&nbsp;</th><td class=\"kluer\">".$q['telefoon']."</td></tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        overzicht();
    }
}

?>