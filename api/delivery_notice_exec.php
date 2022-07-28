<?php

include('DeliveryNoticeClass.php');

$api_object = new DeliveryNoticeClass();

// Add the data to the 'supplier_stock_level_tbl' table. This is a table that has summary stock
if($_GET["action"] == 'add_supplier_delivery_note')
{
 $data = $api_object->addSupplierDeliveryNote();
}

// Add the data to the 'supplier_stock_details_tbl' table. This is a table that has details of the stock, 
// including manufacturer dates, expiry date, etc
if($_GET["action"] == 'add_supplier_stock')
{
 $data = $api_object->addSupplierStock();
}

// Show all stock details in the 'foodbank_stock_details_tbl', filter data using location
if($_GET["action"] == 'show_foodbank_stock')
{
 $data = $api_object->getFoodBankStock($_GET["location"]);
}

// Show all stock details in the 'foodbank_stock_details_tbl', filter data using column id (stockdetail_id)
if($_GET["action"] == 'show_foodbank_stock_by_id')
{
 $data = $api_object->getFoodBankStockById($_GET["id"]);
}

// Update the allocated column for a specific record in the database. The database being updated is the 'foodbank_stock_details_tbl' 
if($_GET["action"] == 'update_foodbank_stock')
{
 $data = $api_object->updateFoodBankStockLevel();
}

// Update the stock details. Making note of the old stock level, the updated stock amounts, and the new stock level amount. 
// The database being updated is the 'actual_stocklevel_tbl' 
if($_GET["action"] == 'update_stock_level')
{
 $data = $api_object->updateActualStockLevel();
}

// Add the data to the 'stock_rejected_tbl' table. 
if($_GET["action"] == 'add_rejected_stock')
{
 $data = $api_object->addRejectedItems();
}

// Show all stock details in the 'stock_rejected_tbl', filter data using column id (rejected_id)
if($_GET["action"] == 'show_rejected_stock')
{
 $data = $api_object->showRejectedStockItems();
}

// Add the data to the 'foodbank_stock_details_tbl' and 'foodbank_stock_movement_tbl' tables. 
if($_GET["action"] == 'add_foodbank_stock')
{
 $data = $api_object->addFoodBankStock();
}

// Show all stock details in the 'supplier_stock_level_tbl', filter data using user_id  (user_id)
if($_GET["action"] == 'show_supplier_user_stock')
{
 $data = $api_object->getSupplierStockByUser($_GET["user_id"]);
}

// Update the status column for a specific record using a unique_code as a reference. The database being updated is the 'supplier_stock_level_tbl' 
if($_GET["action"] == 'update_delivery_status')
{
 $data = $api_object->updateDeliveryNoteStatus();
}

// Update the status column for a specific record using a stockdetail_id as a reference. The database being updated is the 'supplier_stock_details_tbl' 
if($_GET["action"] == 'update_delivered_stock_status')
{
 $data = $api_object->updateStockDetailStatus();
}

// Show specific stock details from the 'supplier_stock_details_tbl', filter data using id column (stockdetail_id)
if($_GET["action"] == 'supplier_stock_id')
{
 $data = $api_object->getSupplierStockByRow($_GET["id"]);
}

// Show specific stock details from the 'supplier_stock_details_tbl', filter data using id column (region)
if($_GET["action"] == 'supplier_stock_region')
{
 $data = $api_object->getSupplierStockByRegion($_GET["region"]);
}

// Show specific stock details from the 'supplier_stock_details_tbl', filter data using region column (region)
if($_GET["action"] == 'show_region_stock')
{
 $data = $api_object->getSupplierPoliciesByRegion($_GET["region"]);
}

// Show specific stock details from the 'supplier_stock_details_tbl', filter data using region column (region)
if($_GET["action"] == 'show_region_stock_limit')
{
 $data = $api_object->getSupplierPoliciesByRegionLm20($_GET["region"]);
}

// Show specific stock details from the 'supplier_stock_details_tbl', filter data using id column (unique_code)
if($_GET["action"] == 'show_supplier_stock_detail')
{
 $data = $api_object->getStockItemDetails($_GET["code"]);
}

// Show specific stock details from the 'supplier_stock_level_tbl', filter data using id column (unique_code)
if($_GET["action"] == 'show_supplier_stock_level')
{
 $data = $api_object->getDeliveryStockDetails($_GET["code"]);
}

// Show specific stock details from the 'actual_stocklevel_tbl', filter data using location and stock_name
if($_GET["action"] == 'get_stock_amount')
{
 $data = $api_object->getCurrenttockCount($_GET["location"], $_GET["stock_name"]);
}

// Remove one stock item from the 'actual_stocklevel_tbl', filter data using region
if($_GET["action"] == 'after_foodpack_create')
{
 $data = $api_object->updateCurrentStockFoodPack();
}

// Update the status column for a specific record using a unique_code as a reference. The database being updated is the 'supplier_stock_level_tbl' 
if($_GET["action"] == 'update_rejected_stock_status')
{
 $data = $api_object->updateRejectedStockStatus();
}

echo json_encode($data);

?>