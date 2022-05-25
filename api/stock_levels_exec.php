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


if($_GET["action"] == 'show_region_stock_details')
{
 $data = $api_object->getStockLevelsByRegionAndStock($_GET["location"], $_GET["stock_name"]);
}

echo json_encode($data);

?>