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

    include("../config/properties.php"); 
    $this->connect = new PDO($SERVERNAME,$USERNAME,$PASSWORD, $OPTIONS);

      
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

   function getRegionActivities($region)
   {

    $query = "SELECT * FROM activities_tbl WHERE region='".$region."' ORDER BY activity_id DESC";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
                }
                
                return $data;
        }
    }


    function getRegionActivitiesLimit20($region)
    {

        $query = "SELECT * FROM activities_tbl WHERE region='".$region."' ORDER BY activity_id DESC  LIMIT 20";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    

    function getUserActivities($user_id)
    {

        $query = "SELECT * FROM activities_tbl WHERE user_id='".$user_id."' ORDER BY activity_id DESC";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    

   function addUserActivity()
   {

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

    function addSecurityActivity()
    {
 
         $form_data = array(
             ':parcel_unique_code'  => $_POST["parcel_unique_code"],
             ':security_name'  => $_POST["security_name"],
             ':security_uid'  => $_POST["security_uid"],
             ':activity'  => $_POST["activity"],
             ':status'  => $_POST["status"],
             ':region'  => $_POST["region"],
             ':driver_1_names'  => $_POST["driver_1_names"],
             ':driver_2_names'  => $_POST["driver_2_names"],
             ':truck_detail'  => $_POST["truck_detail"]
         );
 
         $query = "
         INSERT INTO security_activities_tbl 
         (parcel_unique_code, security_name, security_uid, activity, status, region, driver_1_names, driver_2_names, truck_detail) 
         VALUES 
         (:parcel_unique_code, :security_name, :security_uid, :activity, :status, :region, :driver_1_names, :driver_2_names, :truck_detail)
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
    
    function getSecurityActivities($region)
    {

        $query = "SELECT * FROM security_activities_tbl WHERE region='".$region."' ORDER BY activity_id DESC";
    
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
