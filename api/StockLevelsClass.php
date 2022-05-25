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

   function getStockLevelsByRegion($location){

    $query = "SELECT * FROM actual_stocklevel_tbl WHERE region='".$location."' ORDER BY stock_id DESC";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
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

}

?>
