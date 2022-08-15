<?php

include('FoodPackClass.php');

$api_object = new FoodPackClass();


// Show all stock details in the 'packaged_foodpack_tbl', filter data using region and limit to 20 records
if($_GET["action"] == 'show_foodpack_list_20')
{
 $data = $api_object->getFoodPackListLimit20($_GET["location"]);
}

// Show all stock details in the 'packaged_foodpack_tbl', filter data using region and limit to 20 records
if($_GET["action"] == 'show_foodpack_list_today')
{
 $data = $api_object->getFoodPackListToday($_GET["location"]);
}

// Show all food pack details in the 'packaged_foodpack_tbl', filter data using region 
if($_GET["action"] == 'show_foodpack_list')
{
 $data = $api_object->getFoodPackList($_GET["location"]);
}

// Show all food pack in the 'packaged_foodpack_tbl', filter data using region 
if($_GET["action"] == 'show_foodpack_stage')
{
 $data = $api_object->showFoodPackStages($_GET["location"]);
}

// Show all food pack in the 'packaged_foodpack_tbl', filter data using region 
if($_GET["action"] == 'show_foodpack_stage_today')
{
 $data = $api_object->showFoodPackStagesToday($_GET["location"]);
}

// Show food pack details in the 'packaged_foodpack_tbl', filter data using unique code 
if($_GET["action"] == 'show_foodpack_by_code')
{
 $data = $api_object->getFoodPackByCode($_GET["code"]);
}

// Show list of food pack items from the foodpack_detail_tbl using a reference code
if($_GET["action"] == 'list_foodpack_by_code')
{
 $data = $api_object->showFoodPackListByCode($_GET["code"]);
}

// Show list of food pack items from the foodpack_detail_tbl using a reference code
if($_GET["action"] == 'update_foodpack_state')
{
 $data = $api_object->updateFoodPackState();
}

// Show head of household from the head_of_household_tbl using a id number from user
if($_GET["action"] == 'show_headofhouse_by_id')
{
 $data = $api_object->getHeadOfHouseholdByID($_GET["id_number"]);
}

// Show head of household from the head_of_household_tbl using a cellphone and surname from user
if($_GET["action"] == 'show_headofhouse_by_surname')
{
 $data = $api_object->getHouseholdByPhoneAndName($_GET["cellphone"], $_GET["surname"]);
}

// Allocate the food pack to the beneficiary in a household
if($_GET["action"] == 'allocate_foodpack_household')
{
 $data = $api_object->allocateFoodPackToBeneficiary();
}

// Show list of food pack items from the foodpack_detail_tbl using a reference code
if($_GET["action"] == 'update_headofhousehold_delivery_number')
{
 $data = $api_object->updateFoodPackNumberToBeneficiary();
}

// Show list of food pack items from the foodpack_detail_tbl using a reference code
if($_GET["action"] == 'update_foodpack_beneficiary')
{
 $data = $api_object->updateFoodPackBeneficiaryDetails();
}

// Show all activities from the 'food_parcel_delivery_tbl', filter data using region and limit to 20 records
if($_GET["action"] == 'show_foodpack_delivery_list')
{
 $data = $api_object->getFoodPackDeliveryList($_GET["location"]);
}

echo json_encode($data);

?>