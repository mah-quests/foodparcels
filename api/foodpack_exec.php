<?php

include('FoodPackClass.php');

$api_object = new FoodPackClass();


// Show all stock details in the 'packaged_foodpack_tbl', filter data using region and limit to 20 records
if($_GET["action"] == 'show_foodpack_list_20')
{
 $data = $api_object->getFoodPackListLimit20($_GET["location"]);
}

// Show all stock details in the 'packaged_foodpack_tbl', filter data using region 
if($_GET["action"] == 'show_foodpack_list')
{
 $data = $api_object->getFoodPackList($_GET["location"]);
}


echo json_encode($data);

?>