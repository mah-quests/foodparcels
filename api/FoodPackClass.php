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
      
      include("../config/properties.php"); 
      $this->connect = new PDO($SERVERNAME,$USERNAME,$PASSWORD, $OPTIONS);  
      
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


   function getFoodPackListToday($location)
   {
      $query = "SELECT * FROM packaged_foodpack_tbl WHERE region='".$location."' AND DATE(package_date) = CURDATE() ORDER BY foodpack_id DESC";
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

   function getFoodPackByCode($code)
   {
      $query = "SELECT * FROM packaged_foodpack_tbl WHERE unique_code='".$code."'";
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
   

   function showFoodPackStages($region)
   {
    $query = "
    SELECT 
    ( SELECT COUNT(*) FROM packaged_foodpack_tbl WHERE state='foodbank' AND region='".$region."' ) AS pack_in_foodbank, 
    ( SELECT COUNT(*) FROM packaged_foodpack_tbl WHERE state='intransit' AND region='".$region."') AS pack_in_transit, 
    ( SELECT COUNT(*) FROM packaged_foodpack_tbl WHERE state='delivered' AND region='".$region."') AS pack_delivered;
    ";
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


   function showFoodPackStagesToday($region)
   {
    $query = "
    SELECT 
    ( SELECT COUNT(*) FROM packaged_foodpack_tbl WHERE state='foodbank' AND region='".$region."' AND DATE(package_date) = CURDATE()) AS pack_in_foodbank_today, 
    ( SELECT COUNT(*) FROM packaged_foodpack_tbl WHERE state='intransit' AND region='".$region."' AND DATE(package_date) = CURDATE()) AS pack_in_transit_today, 
    ( SELECT COUNT(*) FROM packaged_foodpack_tbl WHERE state='delivered' AND region='".$region."' AND DATE(package_date) = CURDATE()) AS pack_delivered_today;
    ";
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

   function showFoodPackListByCode($code){

      $query = "SELECT * FROM foodpack_detail_tbl WHERE unique_code='".$code."'";
  
          $statement = $this->connect->prepare($query);
          
          if($statement->execute()){
              while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                  $data[] = $row;
                  }
                  
                  return $data;
          }
   }  

   function updateFoodPackState(){

      $form_data = array(
          ':unique_code'  => $_POST["unique_code"],
          ':foodpack_state'  => $_POST["foodpack_state"],
          ':state'  => $_POST["state"]
      );

      $query = "
      UPDATE packaged_foodpack_tbl 
      SET 
          foodpack_state = :foodpack_state, 
          state = :state 

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

  function updateFoodPackBeneficiaryDetails(){

   $form_data = array(
       ':unique_code'  => $_POST["unique_code"],
       ':deliveredto_idnumber'  => $_POST["deliveredto_idnumber"],
       ':state'  => $_POST["state"]
   );

   $query = "
   UPDATE packaged_foodpack_tbl 
   SET 
       deliveredto_idnumber = :deliveredto_idnumber, 
       deliveredto_code = :deliveredto_code 

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

  function getHeadOfHouseholdByID($id_number)
  {
     $query = "SELECT * FROM head_of_household_tbl WHERE id_number='".$id_number."'";
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

  function getHouseholdByPhoneAndName($cellphone, $surname)
   {
      $query = "SELECT * FROM head_of_household_tbl WHERE cellphone='".$cellphone."' AND surname='".$surname."'";
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
   

   function allocateFoodPackToBeneficiary(){

      $form_data = array(
          ':foodpack_code'  => $_POST["foodpack_code"],
          ':headofhousehold_code'  => $_POST["headofhousehold_code"],
          ':number_of_parcels'  => $_POST["number_of_parcels"], 
          ':region'  => $_POST["region"], 
          ':user_id'  => $_POST["user_id"]
      );
  
      $query = "
      INSERT INTO food_parcel_delivery_tbl 
      (foodpack_code, headofhousehold_code, number_of_parcels, region, user_id) 
      VALUES 
      (:foodpack_code, :headofhousehold_code, :number_of_parcels, :region, :user_id)
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


  function updateFoodPackNumberToBeneficiary(){

   $form_data = array(
      ':unique_code'  => $_POST["unique_code"],
      ':allocated'  => $_POST["allocated"],
      ':allocated_ref'  => $_POST["allocated_ref"]
   );

   $query = "
   UPDATE head_of_household_tbl 
   SET 
   
   no_delivery_times = no_delivery_times + 1,
   allocated = :allocated, 
   allocated_ref = :allocated_ref

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

function getFoodPackDeliveryList($location)
{
   $query = "SELECT * FROM food_parcel_delivery_tbl WHERE region='".$location."' ORDER BY fp_dlv_id DESC LIMIT 20";
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
