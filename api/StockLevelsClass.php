<?php

class StockLevelsClass
{
   private $connect = '';

   function __construct()
   {
      $this->database_connection();
   }

   
   function database_connection()
   {
      $this->connect = new PDO("mysql:host=localhost;dbname=foodbank", "foodbank", "foodbank");
      
   }

    function getAllStockLevels(){
        $query = "SELECT * FROM actual_stocklevel_tbl ORDER BY stock_id DESC";
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

    function getStockLevelsByRegionAndStock($location, $stock_name){


        $query = "SELECT * FROM actual_stocklevel_tbl WHERE region='".$location."' AND stock_name='".$stock_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }  

    function getStockProjectPercentages($location, $stock_name, $project_name){


        $query = "SELECT * FROM foodbank_stock_movement_tbl WHERE region='".$location."' AND stock_name='".$stock_name."' AND project_name='".$project_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }      
    
    function getStockDetailByRegionAndProject($location, $project_name){

        $query = "SELECT * FROM foodbank_stock_details_tbl WHERE region='".$location."' AND project_name='".$project_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }   
    
    function getStockMovementTotalByRegion($location){

        $query = "SELECT SUM(stock_level_amount) as total FROM foodbank_stock_movement_tbl WHERE region='".$location."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }  
    
    
    function getStockMovementTotalByRegionStock($location, $stock_name, $project_name){

        $query = "SELECT SUM(stock_level_amount) as total FROM foodbank_stock_movement_tbl WHERE region='".$location."' AND stock_name='".$stock_name."' AND project_name='".$project_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }      

    
    function getStockMovementByRegionAndProject($location, $project_name){


        $query = "SELECT SUM(stock_level_amount) as total FROM foodbank_stock_movement_tbl WHERE region='".$location."' AND project_name='".$project_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }  

    function getStockMovementDetailRegion($location, $project_name){


        $query = "SELECT * FROM foodbank_stock_movement_tbl WHERE region='".$location."' AND project_name='".$project_name."' AND stock_level_amount > 0";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }      


    function addStockLocation(){

         $form_data = array(
             ':stock_type'  => $_POST["stock_type"],
             ':stock_name'  => $_POST["stock_name"],
             ':stock_brand'  => $_POST["stock_brand"],
             ':items_qty'  => $_POST["items_qty"],
             ':stock_man_date'  => $_POST["stock_man_date"],
             ':stock_exp_date'  => $_POST["stock_exp_date"],
             ':allocated_floor_space'  => $_POST["allocated_floor_space"],
             ':unique_code'  => $_POST["unique_code"],
             ':region'  => $_POST["region"],
             ':project_name'  => $_POST["project_name"],
             ':delivery_month'  => $_POST["delivery_month"]
         );
 
         $query = "
         INSERT INTO stock_allocation_tbl 
         (stock_type, stock_name, stock_brand, items_qty, stock_man_date, stock_exp_date, allocated_floor_space, unique_code, region, project_name, delivery_month) 
         VALUES 
         (:stock_type, :stock_name, :stock_brand, :items_qty, :stock_man_date, :stock_exp_date, :allocated_floor_space, :unique_code, :region, :project_name, :delivery_month)
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
     
     function getAllocatedFoodBankStock($location)
    {
         $query = "SELECT * FROM stock_allocation_tbl WHERE region='".$location."' ORDER BY allocation_id DESC";
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

    function getStockPerProject($location, $project_name){

        $query = " SELECT * FROM foodbank_stock_details_tbl WHERE supplier_ref IN ( SELECT unique_code FROM `supplier_stock_level_tbl` WHERE region='".$location."' AND project_name='".$project_name."') ";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }   

    function getStockLevelsByRegion($location){

        $query = "SELECT * FROM stock_allocation_tbl WHERE region='".$location."' ORDER BY allocation_id DESC";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }

    function getStockDetailForFoodPack($location, $stock_name, $project_name){

        $query = "SELECT * FROM stock_allocation_tbl WHERE region='".$location."' AND stock_name='".$stock_name."' AND project_name='".$project_name."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }       

    function getStockLevelsOnFloor($location, $stock_name, $stock_brand, $project_name, $floor_square){


        $query = "SELECT * FROM stock_allocation_tbl WHERE region='".$location."' AND stock_name='".$stock_name."' AND stock_brand='".$stock_brand."'  AND project_name='".$project_name."'  AND allocated_floor_space='".$floor_square."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }  


    function updateAllocatedStockLevels(){

        $form_data = array(
            ':location'  => $_POST["location"],
            ':stock_name'  => $_POST["stock_name"],
            ':stock_brand'  => $_POST["stock_brand"],
            ':project_name'  => $_POST["project_name"],
            ':floor_square'  => $_POST["floor_square"],
            ':items_qty'  => $_POST["items_qty"]
            
        );

        $query = "
        UPDATE stock_allocation_tbl 
        SET 
            items_qty = :items_qty 

        WHERE region = :location AND stock_name = :stock_name AND stock_brand = :stock_brand AND project_name = :project_name AND allocated_floor_space = :floor_square
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

    function updateStockLevelsFoodPack(){

        $form_data = array(
            ':allocation_id'  => $_POST["allocation_id"]
        );

        $query = "UPDATE stock_allocation_tbl SET items_qty=items_qty-1 WHERE allocation_id = :allocation_id";

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

    function getAllocatedStockByRow($id){

        $query = "SELECT * FROM stock_allocation_tbl WHERE allocation_id='".$id."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    

    function updateCurrentStockFoodPack(){

        $form_data = array(
            ':region'  => $_POST["region"],
            ':project_name'  => $_POST["project_name"]
        );

        $query = "
        UPDATE foodbank_stock_movement_tbl 
        SET 
            stock_level_amount = stock_level_amount - 1

        WHERE region = :region AND project_name = :project_name
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

    function addFoodpackDetails(){

        $form_data = array(
            ':allocation_id'  => $_POST["allocation_id"],
            ':unique_code'  => $_POST["unique_code"]
        
        );

        $query = "
        INSERT INTO foodpack_detail_tbl (unique_code, stock_type, stock_name, stock_brand, stock_man_date, stock_exp_date, from_floor_space, region, project_name)
        SELECT :unique_code, stock_allocation_tbl.stock_type, stock_allocation_tbl.stock_name, stock_allocation_tbl.stock_brand, stock_allocation_tbl.stock_man_date, stock_allocation_tbl.stock_exp_date, stock_allocation_tbl.allocated_floor_space, stock_allocation_tbl.region, stock_allocation_tbl.project_name  
        FROM stock_allocation_tbl
        WHERE stock_allocation_tbl.allocation_id= :allocation_id;
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

   function addFoodpackSummary(){

    $form_data = array(
        ':unique_code'  => $_POST["unique_code"],
        ':region'  => $_POST["region"],
        ':project_name'  => $_POST["project_name"],
        ':pakaged_by'  => $_POST["pakaged_by"],
        ':foodpack_state'  => $_POST["foodpack_state"]
    );

    $query = "
    INSERT INTO packaged_foodpack_tbl 
    (unique_code, region, project_name, pakaged_by, foodpack_state) 
    VALUES 
    (:unique_code, :region, :project_name, :pakaged_by, :foodpack_state)
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
