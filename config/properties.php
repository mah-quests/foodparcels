<?php

    // DATABASE CONNECTION AND SETUP 
    $HOSTNAME      = 'localhost';
    $USERNAME 		= "foodbank"; 						                //username
    $PASSWORD 		= "foodbank"; 						                //password
    $DATABASENAME 	= "foodbank";  		                                //database
    $OPTIONS = array(                                                   //options
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    //    PDO::MYSQL_ATTR_SSL_CA => 'DigiCertGlobalRootCA.crt.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        );
    $SERVERNAME 	= "mysql:host=$HOSTNAME;dbname=$DATABASENAME"; 		//server 


    // API CONNECTION AND SETUP 
    $URLBASE 		= "http://localhost/foodparcels";  		            //URL base
    $APIBASE 		= "$URLBASE/api/";                                   //API    
 
    $QRDIR = "../qr-code/";

?>