<?php

include('BeneficiaryDetailsClass.php');

$api_object = new BeneficiaryDetailsClass();

// Add the data to the 'non_foodbank_staff_tbl' table. This is a table that contains non foodbank staff members 
if($_GET["action"] == 'add_non_foodbank_staff')
{
 $data = $api_object->addNonFoodbankStaffMember();
}

// Add the data to the 'head_of_household_tbl' table. This is a table that contains head of household details
if($_GET["action"] == 'add_head_of_household')
{
 $data = $api_object->addHeadOfHousehold();
}

// Add the data to the 'household_details_tbl' table. This is a table that contains household details
if($_GET["action"] == 'add_household_details')
{
 $data = $api_object->addHouseholdDetails();
}

// Add the data to the 'beneficiary_tbl' table. This is a table that contains household beneficiary details
if($_GET["action"] == 'add_beneficiary_details')
{
 $data = $api_object->addBeneficiaryDetails();
}

// Add the data to the 'change_agent_tbl' table. This is a table that contains change agents details
if($_GET["action"] == 'add_change_agent_details')
{
 $data = $api_object->addChangeAgentDetails();
}

// Add the data to the 'change_agent_tbl' table. This is a table that contains change agents details
if($_GET["action"] == 'add_development_officer')
{
 $data = $api_object->addDevelopmentOfficer();
}

// Show the last 20 beneficiaries to be added into the head_of_household_tbl
if($_GET["action"] == 'show_20_headofhouse')
{
 $data = $api_object->getAllHeadOfHouseholdsTop20($_GET["location"]);
}

// Show all heads of household detail from the head_of_household_tbl using region
if($_GET["action"] == 'show_all_headofhouse')
{
 $data = $api_object->getAllHeadOfHouseholds($_GET["location"]);
}

// Show details of the head_of_household_tbl using a reference code
if($_GET["action"] == 'show_no_fb_staff_detail')
{
 $data = $api_object->getNonFoodbankStaffDetails($_GET["code"]);
}

// Show details of the head_of_household_tbl using a reference code
if($_GET["action"] == 'show_headofhousehold_detail')
{
 $data = $api_object->getHeadOfHouseHoldDetails($_GET["code"]);
}

// Show beneficiary of the head_of_household_tbl using a reference code
if($_GET["action"] == 'show_beneficiary_by_code')
{
 $data = $api_object->showBeneficiaryListByCode($_GET["code"]);
}

// Show household details from the household_details_tbl using a reference code
if($_GET["action"] == 'show_household_details_by_code')
{
 $data = $api_object->showHouseholdDetailsByCode($_GET["code"]);
}

// Show change agent from the change_agent_tbl using a reference code
if($_GET["action"] == 'show_change_agent_by_code')
{
 $data = $api_object->showChangeAgentListByCode($_GET["code"]);
}

// Show development officer from the development_officer_tbl using a reference code
if($_GET["action"] == 'show_development_officer_by_code')
{
 $data = $api_object->showDevelopmentOfficerByCode($_GET["code"]);
}

// Show development officer from the development_officer_tbl using a reference code
if($_GET["action"] == 'generate_distribution_plan')
{
 $data = $api_object->generateFoodDistributionPlan($_GET["suburb"], $_GET["no_of_distribution"]);
}

// Show development officer from the development_officer_tbl using a reference code
if($_GET["action"] == 'update_headofhouse_id')
{
 $data = $api_object->updateHeadHouseholdState();
}

// Show development officer from the development_officer_tbl using a reference code
if($_GET["action"] == 'add_planned_route')
{
 $data = $api_object->addPlannedRoute();
}

// Show all list of routes generated from the distribution_route_tbl using region
if($_GET["action"] == 'show_distr_route_limit')
{
 $data = $api_object->showDistributionRoutesLimit($_GET["location"]);
}

// Show all list of routes generated from the distribution_route_tbl using region
if($_GET["action"] == 'show_distribution_routes')
{
 $data = $api_object->showDistributionRoutes($_GET["location"]);
}

// Show all heads of household detail from the head_of_household_tbl using region
if($_GET["action"] == 'show_distributed_headofhouse')
{
 $data = $api_object->getHeadOfHouseholdByCode($_GET["code"]);
}

// Show all heads of household detail from the head_of_household_tbl using region
if($_GET["action"] == 'show_beneficiary_stages')
{
 $data = $api_object->showBeneficiaryStages($_GET["location"]);
}

// Show all heads of household detail from the head_of_household_tbl using region
if($_GET["action"] == 'show_affected_suburbs')
{
 $data = $api_object->showVariousSuburbs($_GET["location"]);
}

// Show the last 20 beneficiaries to be added into the head_of_household_tbl
if($_GET["action"] == 'show_20_new_headofhouse')
{
 $data = $api_object->getNewHeadOfHouseholdsTop20($_GET["location"]);
}

// Show the last 20 beneficiaries food parcels was delivered to from the head_of_household_tbl
if($_GET["action"] == 'show_20_delivered_headofhouse')
{
 $data = $api_object->getDeliveredHeadOfHouseholdsTop20($_GET["location"]);
}

// Show the last 20 beneficiaries food parcels was delivered over 3 times to, looking from the head_of_household_tbl
if($_GET["action"] == 'show_20_postdelivered_headofhouse')
{
 $data = $api_object->getPostDeliveredHeadOfHouseholdsTop20($_GET["location"]);
}


// Get the total amount of beneficiaries using a unique code from beneficiary_tbl
if($_GET["action"] == 'get_total_beneficiaries_code')
{
 $data = $api_object->countNumberOfBeneficiaries($_GET["code"]);
}

echo json_encode($data);

?>