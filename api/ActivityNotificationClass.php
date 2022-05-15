<?php

class ActivityNotificationClass
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

   function getAllUsersActivities()
   {
      $query = "SELECT * FROM activities_tbl ORDER BY activity_id DESC";
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

   function getRegionActivities($region){

    $query = "SELECT * FROM activities_tbl WHERE region='".$region."' ORDER BY activity_id DESC";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
                }
                
                return $data;
        }
    }


    function getUserActivities($user_id){

        $query = "SELECT * FROM activities_tbl WHERE user_id='".$user_id."' ORDER BY activity_id DESC";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
        }    

   function addUserActivity(){

    $form_data = array(
        ':unique_code'  => $_POST["unique_code"],
        ':region'  => $_POST["region"],
        ':action_performed'  => $_POST["action_performed"],
        ':performed_by'  => $_POST["performed_by"],
        ':user_id'  => $_POST["user_id"]
    );

    $query = "
    INSERT INTO activities_tbl 
    (unique_code, region, action_performed, performed_by, user_id) 
    VALUES 
    (:unique_code, :region, :action_performed, :performed_by, :user_id)
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

}

?>
