<?php
session_start();
include("application/config/config.php");
include("application/config/connect.php");
include("application/config/default_functions.php");
$pageNavId=1;
/*if(!isSet($_GET['taal_id']) || $_GET['taal_id'] == 'en')
{
    $taal_id = 'nl';
    $_SESSION['taal'] = $taal_id;
}
elseif(isSet($_GET['taal_id']) && $_GET['taal_id'] == 'nl')
    {
    $_GET['taal_id']== 'nl';
    $taal_id = 'nl';
    $_SESSION['taal'] = $taal_id;
}*/
    
fHeader($pageNavId);//actief=$pageNavId);

if(!isSet($_SESSION['blad']))
{
 $_SESSION['blad']='index_page';
}
if($_SESSION['blad']!=='index_page')    
{
  $_SESSION['blad']='index_page';
}


if(!isSet($_SESSION["user_authorisatie"]) OR  (isSet($_SESSION["user_authorisatie"]) && $_SESSION["user_authorisatie"] === "usr") &&  isSet($_SESSION["loginnaam"]))
     {
       
       navigatie($pageNavId);    
     }
elseif(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
         {
           navigatieA($pageNavId);
         }
       
//if($_SESSION['taal']==='nl'){ 
$sql = mysql_query("SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId  and `page_taal` = 'nl' and `page_show` ='y' ");
    if (mysql_num_rows($sql)==0)   
      {
         die ("Je hebt geen gegevens tot je beschikking");
      }
while ($content = mysql_fetch_assoc($sql)) 
   {   // show de inhoud
       //echo "<div id=\"kolomLinks\">";
       // echo "<div id=\"messageL\">";
        echo utf8_encode($content["page_content"]);
       //echo "<br /><p>"; 
       //echo utf8_encode($content["page_title"]);
       //echo "<br /><p>";
      // echo "</div>";
   }
//}

/*if($_SESSION['taal']==='en'){ 
$sql = mysql_query("SELECT * FROM `pages_en` WHERE `page_en_nav_id`=$pageNavId  and `page_en_taal` = 'en' and `page_en_show` ='y' ");
   if (mysql_num_rows($sql)==0)   
     {
       die ("Je hebt geen gegevens tot je beschikking");
     }
   while ($content = mysql_fetch_assoc($sql)) 
       {   // show de inhoud
           //echo "<div id=\"kolomLinks\">";
          echo utf8_encode($content["page_en_content"]);
    //echo "<br /><p>"; 
    //echo $content["page_title"];
    //echo "<br /><p>";

       }
}  */  
//global $imagepath;

/*echo "<div id=\"middle\">";
echo "<aside>";
echo "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- advertentie-ruimte -->
<ins class=\"adsbygoogle\"
     style=\"display:block\"
     data-ad-client=\"ca-pub-8569192749694084\"
     data-ad-slot=\"3299327059\"
     data-ad-format=\"auto\"></ins>
 <script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>";
echo "</aside>";
echo "</div>"; */

/*echo "<table id=\"introRechts\"><tbody><tr><td><table id=\"innertable\"><tbody>";
echo "<tr><td><a href=https://ohiostatepress.org/index.htm?/books/book%20pages/spierenburg%20written.html TARGET=\"_blank\">";
echo "<img src=\"$imagepath"."written_in_blood.jpg\" alt=\"written in blood\" width=\"100%\" ></td></a>";
echo "<td><a href=https://www.polity.co.uk/book.asp?ref=9780745658636 TARGET=\"_blank\">";
echo "<img src=\"$imagepath"."a_history_of_murder.jpg\" alt=\"A History of murder\" width=\"100%\"></td></a>";
echo "<td><a href=https://www.polity.co.uk/book.asp?ref=9780745653488 TARGET=\"_blank\">";
echo "<img src=\"$imagepath"."violence_and_punishment.jpg\" alt=\"Violence & Punishment\" width=\"100%\"></td></a>";
echo "<td><a href=http://nl.aup.nl/books/9789053569894-the-prison-experience.html TARGET=\"_blank\">";
echo "<img src=\"$imagepath"."the_prison_experience.jpg\" alt=\"The Prison Experience\" width=\"100%\" ></td></a></tr>";
echo "<tr><td><a href=https://ohiostatepress.org/index.htm?books/book%20pages/spierenburg%20social.html TARGET=\"_blank\">";
echo "<img src=\"$imagepath"."social_control_in_europeA.jpg\" alt=\"social control in europe part1\" width=\"100%\" ></td></a>";
echo "<td><a href=https://ohiostatepress.org/index.htm?books/book%20pages/spierenburg%20social.html TARGET=\"_blank\">";
echo"<img src=\"$imagepath"."social_control_in_europeB.jpg\" alt=\"social control in europe part2\" width=\"100%\" ></td></a>";
echo "<td><a href=http://www.cambridge.org/nl/academic/subjects/history/european-history-after-1450/spectacle-suffering-executions-and-evolution-repression-preindustrial-metropolis-european-experience?format=PB TARGET=\"_blank\">";
echo"<img src=\"$imagepath"."The_Spectacle_of_Suffering.jpg\" alt=\"The_Spectacle_of_Suffering\" width=\"100%\" ></td></a>";
echo "<td><a href=https://ohiostatepress.org/index.htm?/books/book%20pages/spierenburg%20men.htm TARGET=\"_blank\">";
echo"<img src=\"$imagepath"."Men_and_Violence.jpg\" alt=\"Men_and_Violence\" width=\"100%\" ></a></td></tr></tbody></table></td></tr></tbody></table>";
echo "</div>"; */
fFooter();//$active=$pageNavId);
?>