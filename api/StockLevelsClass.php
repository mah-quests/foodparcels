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
             ':region'  => $_POST["region"]
         );
 
         $query = "
         INSERT INTO stock_allocation_tbl 
         (stock_type, stock_name, stock_brand, items_qty, stock_man_date, stock_exp_date, allocated_floor_space, unique_code, region) 
         VALUES 
         (:stock_type, :stock_name, :stock_brand, :items_qty, :stock_man_date, :stock_exp_date, :allocated_floor_space, :unique_code, :region)
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
     
     function getAllocatedFoodBankStock()
    {
         $query = "SELECT * FROM stock_allocation_tbl ORDER BY allocation_id DESC";
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


}

?>
