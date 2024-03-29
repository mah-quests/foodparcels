<?php

class DeliveryNoticeClass
{
    private $connect = '';

    function __construct()
    {
        $this->database_connection();
    }

    function database_connection()
    {

    include("../config/properties.php"); 
    $this->connect = new PDO($SERVERNAME,$USERNAME,$PASSWORD, $OPTIONS);

        
    }

    function getFoodBankStock($location)
    {
        $query = "SELECT * FROM foodbank_stock_details_tbl WHERE region='".$location."' ORDER BY stockdetail_id DESC";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    function getFoodBankStockById($id)
    {
        $query = "SELECT * FROM foodbank_stock_details_tbl WHERE stockdetail_id='".$id."'";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }    

    function getSupplierStockLevels()
    {
        $query = "SELECT * FROM supplier_stock_level_tbl ORDER BY stocklevel_id DESC";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    function getTopFiftySupplierStockLevels(){

        $query = "SELECT * FROM supplier_stock_level_tbl ORDER BY stocklevel_id DESC LIMIT 20";
        
        $statement = $this->connect->prepare($query);
        
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    function getSupplierStockByRow($id){

        $query = "SELECT * FROM supplier_stock_details_tbl WHERE stockdetail_id='".$id."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }

    function getSupplierStockByRegion($region){

        $query = "SELECT * FROM supplier_stock_details_tbl WHERE region='".$region."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }

    function getSupplierPoliciesByRegion($region){

        $query = "SELECT * FROM supplier_stock_level_tbl WHERE region='".$region."' ORDER BY stocklevel_id DESC";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    } 

    function getSupplierPoliciesByRegionLm20($region){

        $query = "SELECT * FROM supplier_stock_level_tbl WHERE region='".$region."' ORDER BY stocklevel_id DESC LIMIT 20";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }     

    function getStockItemDetails($code){

        $query = "SELECT * FROM supplier_stock_details_tbl WHERE unique_code='".$code."' ORDER BY stockdetail_id DESC";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }

    function getDeliveryStockDetails($code){

        $query = "SELECT * FROM supplier_stock_level_tbl WHERE unique_code='".$code."' ORDER BY stocklevel_id DESC";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    

    function addSupplierDeliveryNote(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':region'  => $_POST["region"],
            ':project_name'  => $_POST["project_name"],
            ':stock_type'  => $_POST["stock_type"],
            ':est_date_of_delivery'  => $_POST["est_date_of_delivery"],
            ':stock_status'  => $_POST["stock_status"],
            ':driver_full_name'  => $_POST["driver_full_name"],
            ':driver_cellphone'  => $_POST["driver_cellphone"],
            ':truck_details'  => $_POST["truck_details"],
            ':truck_registration_num'  => $_POST["truck_registration_num"], 
            ':user_id'  => $_POST["user_id"], 
            ':status'  => $_POST["status"],
            ':previous_reference'  => $_POST["previous_reference"],
            ':delivery_month'  => $_POST["delivery_month"]
        );

        $query = "
        INSERT INTO supplier_stock_level_tbl 
        (unique_code, region, project_name, stock_type, est_date_of_delivery, stock_status, driver_full_name, driver_cellphone, truck_details, truck_registration_num, user_id, status, previous_reference, delivery_month) 
        VALUES 
        (:unique_code, :region, :project_name, :stock_type, :est_date_of_delivery, :stock_status, :driver_full_name, :driver_cellphone, :truck_details, :truck_registration_num, :user_id, :status, :previous_reference, :delivery_month)
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'failed' => '0'
            );
        }

        return $data;

    }

    function addSupplierStock(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':stock_type'  => $_POST["stock_type"],
            ':stock_name'  => $_POST["stock_name"],
            ':stock_brand'  => $_POST["stock_brand"],
            ':stock_level_amount'  => $_POST["stock_level_amount"],
            ':stock_batch_number'  => $_POST["stock_batch_number"],
            ':stock_man_date'  => $_POST["stock_man_date"],
            ':stock_exp_date'  => $_POST["stock_exp_date"],
            ':user_id'  => $_POST["user_id"], 
            ':status'  => $_POST["status"],
            ':project_name'  => $_POST["project_name"],
            ':region'  => $_POST["region"],
            ':delivery_month'  => $_POST["delivery_month"]
        );

        $query = "
        INSERT INTO supplier_stock_details_tbl 
        (unique_code, stock_type, stock_name, stock_brand, stock_level_amount, stock_batch_number, stock_man_date, stock_exp_date, user_id, status, project_name, region, delivery_month) 
        VALUES 
        (:unique_code, :stock_type, :stock_name, :stock_brand, :stock_level_amount, :stock_batch_number, :stock_man_date, :stock_exp_date, :user_id, :status, :project_name, :region, :delivery_month)
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'failed' => '0'
            );
        }

        return $data;

    }

    function addFoodBankStock(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':stock_type'  => $_POST["stock_type"],
            ':stock_name'  => $_POST["stock_name"],
            ':stock_brand'  => $_POST["stock_brand"],
            ':stock_level_amount'  => $_POST["stock_level_amount"],
            ':stock_batch_number'  => $_POST["stock_batch_number"],
            ':stock_man_date'  => $_POST["stock_man_date"],
            ':stock_exp_date'  => $_POST["stock_exp_date"],
            ':user_id'  => $_POST["user_id"], 
            ':region'  => $_POST["region"],
            ':status'  => $_POST["status"], 
            ':project_name'  => $_POST["project_name"],
            ':supplier_ref'  => $_POST["supplier_ref"],            
            ':delivery_month'  => $_POST["delivery_month"]
        );

        $query = "
        INSERT INTO foodbank_stock_details_tbl
        (unique_code, stock_type, stock_name, stock_brand, stock_level_amount, stock_batch_number, stock_man_date, stock_exp_date, user_id, region, status, project_name, supplier_ref, delivery_month) 
        VALUES 
        (:unique_code, :stock_type, :stock_name, :stock_brand, :stock_level_amount, :stock_batch_number, :stock_man_date, :stock_exp_date, :user_id, :region, :status, :project_name, :supplier_ref, :delivery_month)
        ";

        $statement = $this->connect->prepare($query);


        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'failed' => '0'
            );
        }        

        $query = "
        INSERT INTO foodbank_stock_movement_tbl
        (unique_code, stock_type, stock_name, stock_brand, stock_level_amount, stock_batch_number, stock_man_date, stock_exp_date, user_id, region, status, project_name, supplier_ref, delivery_month) 
        VALUES 
        (:unique_code, :stock_type, :stock_name, :stock_brand, :stock_level_amount, :stock_batch_number, :stock_man_date, :stock_exp_date, :user_id, :region, :status, :project_name, :supplier_ref, :delivery_month)
        ";

        $statement = $this->connect->prepare($query);

        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'failed' => '0'
            );
        }

        return $data;

    }

    function updateDeliveryNote(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':region'  => $_POST["region"],
            ':project_name'  => $_POST["project_name"],
            ':stock_type'  => $_POST["stock_type"],
            ':est_date_of_delivery'  => $_POST["est_date_of_delivery"],
            ':stock_status'  => $_POST["stock_status"],
            ':driver_full_name'  => $_POST["driver_full_name"],
            ':driver_cellphone'  => $_POST["driver_cellphone"],
            ':truck_details'  => $_POST["truck_details"],
            ':truck_registration_num'  => $_POST["truck_registration_num"],
            ':stocklevel_id'  => $_POST["stocklevel_id"]
        );

        $query = "
        UPDATE supplier_stock_level_tbl 
        SET 
            unique_code = :unique_code, 
            region = :region, 
            project_name = :project_name, 
            stock_type = :stock_type, 
            est_date_of_delivery = :est_date_of_delivery, 
            stock_status = :stock_status, 
            driver_full_name = :driver_full_name, 
            driver_cellphone = :driver_cellphone, 
            truck_details = :truck_details, 
            truck_registration_num = :truck_registration_num
        WHERE stocklevel_id = :stocklevel_id
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    } 

    function updateDeliveryNoteStatus(){

        $form_data = array(
            ':status'  => $_POST["status"],
            ':unique_code'  => $_POST["unique_code"]
        );

        $query = "
        UPDATE supplier_stock_level_tbl 
        SET 
            status = :status

        WHERE unique_code = :unique_code
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    } 

    function updateFoodBankStockLevel(){

        $form_data = array(
            ':allocated'  => $_POST["allocated"],
            ':stockdetail_id'  => $_POST["stockdetail_id"]
        );

        $query = "
        UPDATE foodbank_stock_details_tbl 
        SET 
        
            allocated = :allocated 

        WHERE stockdetail_id = :stockdetail_id
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;

    }  

    function updateActualStockLevel(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':current_stock_level'  => $_POST["current_stock_level"],
            ':old_stock_level'  => $_POST["old_stock_level"],
            ':updated_stock_level'  => $_POST["updated_stock_level"],
            ':update_activity'  => $_POST["update_activity"],
            ':stock_id'  => $_POST["stock_id"]
        );

        $query = "
        UPDATE actual_stocklevel_tbl 
        SET 
            unique_code = :unique_code, 
            current_stock_level = :current_stock_level, 
            old_stock_level = :old_stock_level, 
            updated_stock_level = :updated_stock_level, 
            update_activity = :update_activity 
        WHERE stock_id = :stock_id
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;

    }   

    function deleteDeliveryNote($id){
        $query = "DELETE FROM supplier_stock_level_tbl WHERE stocklevel_id = '".$id."'";
        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            $data[] = array(
                'success' => '1'
            );
        } else {
        $data[] = array(
            'success' => '0'
        );
        }

        return $data;
    }

    function addStockItems(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':stock_type'  => $_POST["stock_type"],
            ':stock_name'  => $_POST["stock_name"],
            ':stock_brand'  => $_POST["stock_brand"],
            ':stock_level_amount'  => $_POST["stock_level_amount"],
            ':stock_batch_number'  => $_POST["stock_batch_number"],
            ':stock_man_date'  => $_POST["stock_man_date"],
            ':stock_exp_date'  => $_POST["stock_exp_date"]
        );

        $query = "
        INSERT INTO supplier_stock_details_tbl 
        (unique_code, stock_type, stock_name, stock_brand, stock_level_amount, stock_batch_number, stock_man_date, stock_exp_date) 
        VALUES 
        (:unique_code, :stock_type, :stock_name, :stock_brand, :stock_level_amount, :stock_batch_number, :stock_man_date, :stock_exp_date)
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }

        return $data;

    }    

    function showRejectedStockItems()
    {
        $query = "SELECT * FROM stock_rejected_tbl ORDER BY rejected_id DESC";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    function addRejectedItems(){

        $form_data = array(
            ':supplier_unique_code'  => $_POST["supplier_unique_code"],
            ':manager_unique_code'  => $_POST["manager_unique_code"],
            ':supplier_delivery_date'  => $_POST["supplier_delivery_date"],
            ':stock_type'  => $_POST["stock_type"],
            ':stock_name'  => $_POST["stock_name"],
            ':rejected_amounts'  => $_POST["rejected_amounts"],
            ':status'  => $_POST["status"],
            ':reason_of_rejection'  => $_POST["reason_of_rejection"],
            ':logged_by'  => $_POST["logged_by"],
            ':logged_by_user_id'  => $_POST["logged_by_user_id"],
            ':project_name'  => $_POST["project_name"],
            ':region'  => $_POST["region"],
            ':delivery_month'  => $_POST["delivery_month"]
        );

        $query = "
        INSERT INTO stock_rejected_tbl 
        (supplier_unique_code, manager_unique_code, supplier_delivery_date, stock_type, stock_name, rejected_amounts, status, reason_of_rejection, logged_by, logged_by_user_id, project_name, region, delivery_month) 
        VALUES 
        (:supplier_unique_code, :manager_unique_code, :supplier_delivery_date, :stock_type, :stock_name, :rejected_amounts, :status, :reason_of_rejection, :logged_by, :logged_by_user_id, :project_name, :region, :delivery_month)
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }

        return $data;

    }   

    function updateStockItems(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':stock_type'  => $_POST["stock_type"],
            ':stock_name'  => $_POST["stock_name"],
            ':stock_brand'  => $_POST["stock_brand"],
            ':stock_level_amount'  => $_POST["stock_level_amount"],
            ':stock_batch_number'  => $_POST["stock_batch_number"],
            ':stock_man_date'  => $_POST["stock_man_date"],
            ':stock_exp_date'  => $_POST["stock_exp_date"],
            ':stockdetail_id'  => $_POST["stockdetail_id"]
        );

        $query = "
        UPDATE supplier_stock_details_tbl 
        SET 
            unique_code = :unique_code, 
            stock_type = :stock_type, 
            stock_name = :stock_name, 
            stock_brand = :stock_brand, 
            stock_level_amount = :stock_level_amount, 
            stock_batch_number = :stock_batch_number, 
            stock_man_date = :stock_man_date, 
            stock_exp_date = :stock_exp_date
        WHERE stockdetail_id = :stockdetail_id
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    } 

    function getCurrenttockCount($location, $stock_name){

        $query = "SELECT * FROM actual_stocklevel_tbl WHERE region='".$location."' AND stock_name='".$stock_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    
    
    function getSupplierStockByUser($user_id){

        $query = "SELECT * FROM supplier_stock_level_tbl WHERE user_id='".$user_id."' ORDER BY stocklevel_id DESC";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            
            return $data;
        }
    }

    function updateStockDetailStatus(){

        $form_data = array(
            ':status'  => $_POST["status"],
            ':stockdetail_id'  => $_POST["stockdetail_id"]
        );

        $query = "
        UPDATE supplier_stock_details_tbl 
        SET 
            status = :status

        WHERE stockdetail_id = :stockdetail_id
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;        
        
    }

    function updateCurrentStockFoodPack(){

        $form_data = array(
            ':region'  => $_POST["region"],
            ':unique_code'  => $_POST["unique_code"],
            ':update_activity'  => $_POST["update_activity"]
        );

        $query = "
        UPDATE actual_stocklevel_tbl 
        SET 

            current_stock_level = current_stock_level - 1, 
            old_stock_level = current_stock_level + 1,
            updated_stock_level = -1, 
            unique_code = :unique_code,
            update_activity = :update_activity
        
        WHERE region = :region
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    } 

    function updateRejectedStockStatus(){

        $form_data = array(
            ':supplier_unique_code'  => $_POST["supplier_unique_code"],
            ':stock_name'  => $_POST["stock_name"],
            ':status'  => $_POST["status"]
        );

        $query = "
        UPDATE stock_rejected_tbl 
        SET 
            status = :status

        WHERE supplier_unique_code = :supplier_unique_code AND stock_name = :stock_name
        ";

        $statement = $this->connect->prepare($query);
        if($statement->execute($form_data)){
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }     

}

?>
