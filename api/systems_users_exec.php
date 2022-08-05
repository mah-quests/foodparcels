<?php

include('UsersClass.php');

$api_object = new UsersClass();

// Add the data to the 'user_login_tbl' table. This is a table that stores user login details
if($_GET["action"] == 'add_systems_user')
{
 $data = $api_object->addSystemUser();
}

// Before resetting the password, check the username and code fields
if($_GET["action"] == 'check_user_registration')
{
 $data = $api_object->checkUsernameCode($_GET["username"], $_GET["code"]);
}

// Update the data to the 'user_login_tbl' table. Changing the password for eligable users
if($_GET["action"] == 'reset_user_password')
{
 $data = $api_object->updateUserPassword();
}

// Check the username and password to authenticate users
if($_GET["action"] == 'check_user_login')
{
 $data = $api_object->checkLoginDetails($_GET["username"]);
}

// Add the data to the 'customer_experience_tbl' table. This is a table that stores user login details
if($_GET["action"] == 'add_customer_experience')
{
 $data = $api_object->addCustomerSurvey();
}

// Get all the results of all the surveys
if($_GET["action"] == 'show_all_surveys')
{
 $data = $api_object->getSurveysDone();
}

// Gets average customer expeience for all surveys
if($_GET["action"] == 'view_customer_experience')
{
 $data = $api_object->showCustomerExpirience($_GET["region"]);
}

echo json_encode($data);

?>