<?php

class FoodPackClass
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

   function getFoodPackListLimit20($location)
   {
      $query = "SELECT * FROM packaged_foodpack_tbl WHERE region='".$location."' ORDER BY foodpack_id DESC LIMIT 20";
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


   function getFoodPackList($location)
   {
      $query = "SELECT * FROM packaged_foodpack_tbl WHERE region='".$location."'  ORDER BY foodpack_id DESC";
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

}

?>
