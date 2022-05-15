<?php

include('DeliveryNoticeClass.php');

$api_object = new DeliveryNoticeClass();


if($_GET["action"] == 'add_supplier_delivery_note')
{
 $data = $api_object->addSupplierDeliveryNote();
}

if($_GET["action"] == 'add_supplier_stock')
{
 $data = $api_object->addSupplierStock();
}

if($_GET["action"] == 'add_foodbank_stock')
{
 $data = $api_object->addFoodBankStock();
}

if($_GET["action"] == 'show_supplier_user_stock')
{
 $data = $api_object->getSupplierStockByUser($_GET["user_id"]);
}

if($_GET["action"] == 'update_delivery_status')
{
 $data = $api_object->updateDeliveryNoteStatus();
}

if($_GET["action"] == 'update_delivered_stock_status')
{
 $data = $api_object->updateStockDetailStatus();
}

if($_GET["action"] == 'supplier_stock_id')
{
 $data = $api_object->getSupplierStockByRow($_GET["id"]);
}

if($_GET["action"] == 'show_region_stock')
{
 $data = $api_object->getSupplierPoliciesByRegion($_GET["region"]);
}

if($_GET["action"] == 'show_supplier_stock_detail')
{
 $data = $api_object->getStockItemDetails($_GET["code"]);
}

if($_GET["action"] == 'show_supplier_stock_level')
{
 $data = $api_object->getDeliveryStockDetails($_GET["code"]);
}

echo json_encode($data);

?>