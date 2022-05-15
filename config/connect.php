<?php

//main connection file for both admin & front end
include 'properties.php';

$limit = 20;

// Create connection
$db = mysqli_connect($SERVERNAME, $USERNAME, $PASSWORD, $DATABASENAME); // connecting 

// Check connection
if (!$db) {       //checking connection to DB	
    
    die("Connection to database failed, please contact the administrator: " . mysqli_connect_error());

}else{
    
}
