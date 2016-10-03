<?php

/*echo "<style>
        td.human {
    padding-bottom:  15px;
}

span.logoL {
    font-size: 90%;
    font-weight: 600;
    color:orange;
}

span.logoR {
    font-size: 90%;
    font-weight: 600;
    color:blue;    
}

div#logoDynamisch {
    width: 140px;
    height: 35px;
    display: inline;
}

ul#middenstuk {
    
}

ul.logoM {
    padding-left: 0px;
    padding-bottom:0px;
}

ul.logoM li {
    list-style-type:none;
    display: block;
}

span.ic {
    font-weight: 600;
    margin-left: 4px;
    color: #9999ff;
}
</style>";*/
    

//echo "<div id=\"logoDynamisch\" class=\"table-responsive\">";
    echo "<table>";
        echo "<tr>";
             echo "<td class=\"human\">";
                   echo "<span class=\"logoL\">human</span>";
             echo "</td>";  
             echo "<td>";
                        echo "<ul class=\"logoM\" id=\"middenstuk\">";
                              echo "<li>";
                                   echo "<img src=\"".$GLOBALS['imagepath']."headerPijlOmhoogCB.png\" alt=\"headerPijlOmhoog\" width=\"25\" height=\"15\"  >";
                             echo "</li>";
                             echo "<li>";
                                   echo "<span class=\"ic\">IC</span>";
                             echo "</li>";
                             echo "<li>";
                                   echo "<img src=\"".$GLOBALS['imagepath']."headerPijlOmlaagC2B.png\" alt=\"headerPijlOmlaag\" width=\"25\" height=\"15\" >";
                             echo "</li>";
                       echo "</ul>";     
             echo "</td>";
             echo "<td class=\"human\">";
                   echo "<span class=\"logoR\">development</span>";
             echo "</td>";
           echo "</tr>";                
    echo "</table>";                
//echo "</div>";

?>
