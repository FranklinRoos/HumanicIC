<?php

        if ( !isset($connection ) )
        {
                $connection = mysqli_connect ($host, $user, $pass)
        or die ("Could not connect");
                mysqli_select_db($connection, $database) or die("Unable to select database");
        }
        

?>
