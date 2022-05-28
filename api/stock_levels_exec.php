<?php

include('StockLevelsClass.php');

$api_object = new StockLevelsClass();


if($_GET["action"] == 'show_all_stock_levels')
{
 $data = $api_object->getAllStockLevels();
}

if($_GET["action"] == 'show_region_stock_levels')
{
 $data = $api_object->getStockLevelsByRegion($_GET["location"]);
}

if($_GET["action"] == 'add_stock_floor_location')
{
 $data = $api_object->addStockLocation();
}

if($_GET["action"] == 'show_region_stock_details')
{
 $data = $api_object->getStockLevelsByRegionAndStock($_GET["location"], $_GET["stock_name"]);
}

if($_GET["action"] == 'allocated_fb_stock_by_region')
{
 $data = $api_object->getStockLevelsByRegion($_GET["location"]);
}

if($_GET["action"] == 'show_allocated_foodbank_stock')
{
 $data = $api_object->getAllocatedFoodBankStock();
}

if($_GET["action"] == 'show_project_stock_details')
{
 $data = $api_object->getStockPerProject($_GET["location"], $_GET["project_name"]);
}

echo json_encode($data);

?>