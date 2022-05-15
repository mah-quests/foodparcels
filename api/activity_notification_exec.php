<?php

include('ActivityNotificationClass.php');

$api_object = new ActivityNotificationClass();


if($_GET["action"] == 'add_user_activity')
{
 $data = $api_object->addUserActivity();
}

if($_GET["action"] == 'all_user_activities')
{
 $data = $api_object->getAllUsersActivities();
}

if($_GET["action"] == 'user_activities')
{
 $data = $api_object->getUserActivities($_GET["user_id"]);
}

if($_GET["action"] == 'region_activities')
{
 $data = $api_object->getRegionActivities($_GET["region"]);
}

echo json_encode($data);

?>