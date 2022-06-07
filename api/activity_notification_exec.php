<?php

include('ActivityNotificationClass.php');

$api_object = new ActivityNotificationClass();

// Add the data to the 'activities_tbl' table. This is a table that stores user activities
if($_GET["action"] == 'add_user_activity')
{
 $data = $api_object->addUserActivity();
}

// Show all stock details in the 'activities_tbl' with no filter, displaying activity_id by descending order
if($_GET["action"] == 'all_user_activities')
{
 $data = $api_object->getAllUsersActivities();
}

// Show all stock details in the 'activities_tbl', filter data using user_id
if($_GET["action"] == 'user_activities')
{
 $data = $api_object->getUserActivities($_GET["user_id"]);
}

// Show all stock details in the 'activities_tbl', filter data using region
if($_GET["action"] == 'region_activities')
{
 $data = $api_object->getRegionActivities($_GET["region"]);
}

echo json_encode($data);

?>