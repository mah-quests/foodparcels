<?php

include('StockLevelsClass.php');

$api_object = new StockLevelsClass();

// Show all stock details in the 'actual_stocklevel_tbl' with no filter, displaying stock_id by descending order
if($_GET["action"] == 'show_all_stock_levels')
{
 $data = $api_object->getAllStockLevels();
}

// Show all stock details in the 'actual_stocklevel_tbl', filter data using region by descending order
if($_GET["action"] == 'show_region_stock_levels')
{
 $data = $api_object->getStockLevelsByRegion($_GET["location"]);
}

// Add the data to the 'stock_allocation_tbl' table. Showing the floor square area where specific stock has been placed
if($_GET["action"] == 'add_stock_floor_location')
{
 $data = $api_object->addStockLocation();
}

// Show all stock details in the 'actual_stocklevel_tbl', filter data using region and by stock_name by descending order
if($_GET["action"] == 'show_region_stock_details')
{
 $data = $api_object->getStockLevelsByRegionAndStock($_GET["location"], $_GET["stock_name"]);
}

// Show all stock details in the 'actual_stocklevel_tbl', filter data using region, stock_name  and by project by descending order
if($_GET["action"] == 'stock_name_total_region')
{
 $data = $api_object->getStockMovementTotalByRegionStock($_GET["location"], $_GET["stock_name"], $_GET["project_name"]);
}

// Show all stock details in the 'foodbank_stock_movement_tbl', filter data using region and by project_name by descending order. 
// Also the stock count has to be over 0
if($_GET["action"] == 'show_project_stock_details')
{
 $data = $api_object->getStockMovementDetailRegion($_GET["location"], $_GET["project_name"]);
}

// Show the sum total number of stock from the 'foodbank_stock_movement_tbl', filter data using region. 
if($_GET["action"] == 'show_region_total')
{
 $data = $api_object->getStockMovementTotalByRegion($_GET["location"]);
}

// Show the sum total number of stock from the 'foodbank_stock_movement_tbl', filter data using region and by project name
if($_GET["action"] == 'show_region_total_project')
{
 $data = $api_object->getStockMovementByRegionAndProject($_GET["location"], $_GET["project_name"]);
}

// Show all stock details in the 'stock_allocation_tbl', filter data using region
if($_GET["action"] == 'show_allocated_foodbank_stock')
{
 $data = $api_object->getAllocatedFoodBankStock($_GET["location"]);
}

// Show all stock details in the 'stock_allocation_tbl', filter data using region, by stock name and then by project name
if($_GET["action"] == 'show_foodparcel_available_stock')
{
    $data = $api_object->getStockDetailForFoodPack($_GET["location"], $_GET["stock_name"], $_GET["project_name"]);
}

// Show all stock details in the 'stock_allocation_tbl', filter data using region, by stock name, stock brand,  project name  and then by floor_square allocation
if($_GET["action"] == 'check_allocated_stock')
{
    $data = $api_object->getStockLevelsOnFloor($_GET["location"], $_GET["stock_name"], $_GET["stock_brand"], $_GET["project_name"], $_GET["floor_square"]);
}

// Update the stock numbers column for a specific record using region, stock_name, stock brand, project_name and floor_square allocation
if($_GET["action"] == 'update_allocated_stock')
{
 $data = $api_object->updateAllocatedStockLevels();
}

// Show all stock details in the 'stock_allocation_tbl', filter data using id (allocated_stock_id)
if($_GET["action"] == 'allocated_stock_id')
{
 $data = $api_object->getAllocatedStockByRow($_GET["id"]);
}

// Update the items_qty by removing 1 item from the stock numbers, working from the 'stock_allocation_tbl' for a specific record using id (allocation_id)
if($_GET["action"] == 'create_foodpack')
{
 $data = $api_object->updateStockLevelsFoodPack();
}

// Update the stock_level_amount by removing 1 item from the stock numbers, working from the 'foodbank_stock_movement_tbl' for a specific record using region and project_name
if($_GET["action"] == 'update_current_stock_after_foodpack')
{
 $data = $api_object->updateCurrentStockFoodPack();
}

// Add the data to the 'packaged_foodpack_tbl' table. Showing food parcel summary for each food parcel
if($_GET["action"] == 'add_foodpack_summary')
{
 $data = $api_object->addFoodpackSummary();
}

// Add the data to the 'foodpack_detail_tbl' table. Showing food parcel contents for each project
if($_GET["action"] == 'add_foodpack_details')
{
 $data = $api_object->addFoodpackDetails();
}

echo json_encode($data);

?>