
function fHeader($pageNavId="1")
{
    global $connection;
    
    echo "<!DOCTYPE html>";
    echo "<html lang=\"en\">";
    echo "<head>";
   <!-- echo "<link href='https://fonts.googleapis.com/css?family=Lateef' rel='stylesheet' type='text/css'>"; -->
    <!-- echo "<div id =\"header\" role=\"banner\">"; -->
    echo "<meta charset=\"utf-8\">";
    echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- haal de gegevens voor de desbetreffende pagina uit de database -->
    $sql = mysqli_query($connection, "SELECT * FROM `pages` where `page_nav_id`=$pageNavId and `page_show` ='y'")
                or die ("Je hebt geen gegevens tot je beschikking");
    if (mysqli_num_rows($sql)==0)   
    {
        die ("Je hebt geen gegevens tot je beschikking");
    }
    while ($content = mysqli_fetch_assoc($sql)) 
    {
        echo "<meta name=\"description\" content=\"".$content["page_description"]."\">";
        <!--echo "<meta name=\"keywords\" content=\"".$content["page_keywords"]."\">"; -->
    }
    echo "<meta name=\"author\" content=\"Franklin Roos, Thijs v Hout,Bart Kijlstra, Ron de Wit & Sellahatin\">";
    echo "<title>Humanic IC</title>";
    //<!-- Bootstrap -->
   //echo "<link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">";
    //<!-- Optional theme -->
   echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/bootstrap.min.css\" type=\"text/css\">";
    //<!-- My theme -->
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/dropmenu.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/slider.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/slider.less\" type=\"text/css\"/>";    
    <!-- echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/style.css\" type=\"text/css\"/>"; -->  
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/fuikweb.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/half-slider.css\" type=\"text/css\"/>";

    
    echo "<script src=\"https://code.jquery.com/jquery-2.2.4.min.js\"  ></script>";
    echo  "<script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.1.1/bootstrap-slider.js\"></script>";
    echo "<script src=\"".$GLOBALS['path']."assets/js/slider.js\" ></script>";
    
    
    $path=$GLOBALS['path'];
    <!--//$path=substr_replace($path ,"",-1);
    //echo "<script src=\"$path/jquery-1.11.3.min.js\"></script> -->
    echo "<script type=\"text/javascript\">
    <!--
    function inofuitLoggen(idinuit) {
    location.replace('".$path."/application/modules/humanic-portal/login.php?idinuit='+idinuit);}
    -->
    </script>";
    <!--//echo "<script type=\"text/javascript\" src=\"assets/flash-flowplayer/flowplayer-3.2.13.min.js\"></script> 
    //<script type=\"text/javascript\" src=\"assets/flash-flowplayer/flowplayer.ipad-3.2.13.min.js\"></script>";-->
    <!--echo "<style type=\text/css>";
    echo "#ps01 { width: 100%; height: 100%; position: absolute; top: 0; left: 0; }";
    echo ".videovak { position: relative; width: 100%; height: 0; padding-bottom: 62.5%; }";
    echo "</style>"; -->
    echo "</head>";
    
    echo "<body>";
    echo "<div id=\"contentwrapper\">";
           <!--//echo "<br><br><br><br>";-->

          <!--// echo "<a href=\"".$GLOBALS['path']."index.php?taal_id=nl\">";
          // echo "<img alt=\"logo\" width=\"300\" style=\"margin: -30px 0px 5px 0px;\" src=\"".$GLOBALS['path']."assets/images-humanic/header.png\">";
           //echo "</a>"; -->
    
				    echo "<div class=\"navbar-form pull-right\">";
                 //checken op inloggen en de knop in/uitloggen tonen
                if (isSet($_SESSION["loginnaam"])) 
				{
                         $date = $_SESSION['user_sinds'];//(yyyy-mm-dd)
                         $datesplit = explode('-',$date);
                         $maanden = array('jan','feb','maart','april','mei','juni','juli','aug','sep','okt','nov','dec');
                         $datum = ($datesplit[2]*1)."-".$maanden[$datesplit[1]-1]."-".$datesplit[0];//de index bij $maanden[$datesplit[1] wordt met 1 verminderd omdat de array '$maanden' met 0 begint
         
                         echo "<input type =\"button\" id=\"login\" onclick=\"inofuitLoggen(0)\" value=\"Uitloggen\" class=\"btn\"></button>";
                    echo "</div>"; 
		            echo "<div class=\"navbar-form pull-right\">";
                         echo "<div id=\"inlognaam\"><a class=\"inlognm\">";
                            echo "".ucfirst($_SESSION["loginnaam"])."</a><br/>";      
                            echo "<a class=\"regsinds\">Geregistreerd sinds: ".$datum."</a>"; 
			             echo "</div>";
		            echo "</div>";
				}      
                else
                  {
                     echo "<input type =\"button\" id=\"login\" onclick=\"inofuitLoggen(1)\" value=\"Inloggen\" class=\"btn\"></button></div>";
                  }
            echo "</form>"; 
         echo "<div class=\"push\"></div>";
    //echo "</div>";
    echo "</div>";
}