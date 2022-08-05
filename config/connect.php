<?php

//main connection file for both admin & front end
include 'properties.php';

// Create connection
$db = new PDO($SERVERNAME,$USERNAME,$PASSWORD, $OPTIONS);

// Check connection
if (!$db) {       //checking connection to DB	
    
    die("Connection to database failed, please contact the administrator: " . mysqli_connect_error());

}else{
    
}

?>