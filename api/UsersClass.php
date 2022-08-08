<?php

class UsersClass
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

   function addSystemUser(){

    $hash_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $form_data = array(
        
        ':first_name'  => $_POST["first_name"],
        ':surname'  => $_POST["surname"],
        ':username'  => $_POST["username"],
        ':password'  => $hash_password, 
        ':role'  => $_POST["role"], 
        ':region'  => $_POST["region"], 
        ':foodbank'  => $_POST["foodbank"], 
        ':code'  => $_POST["code"],
        ':address'  => $_POST["address"],
        ':cellphone'  => $_POST["cellphone"], 
        ':id_number'  => $_POST["id_number"]
        
    );

    $query = "
    INSERT INTO user_login_tbl 
    (first_name, surname, username, password, role, region, foodbank, code, address, cellphone, id_number) 
    VALUES 
    (:first_name, :surname, :username, :password, :role, :region, :foodbank, :code, :address, :cellphone, :id_number)
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

function checkUsernameCode($username, $code)
{

    $query = "SELECT * FROM user_login_tbl WHERE username='".$username."' AND code='".$code."'";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
                }
                
                return $data;
        }
}  


function updateUserPassword(){

    $hash_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $form_data = array(
        ':user_id'  => $_POST["user_id"],
        ':password'  => $hash_password
    );

    $query = "
    UPDATE user_login_tbl 
    SET 
        password = :password

    WHERE user_id = :user_id
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

function checkLoginDetails($username)
{


    $query = "SELECT * FROM user_login_tbl WHERE username='".$username."'";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
                }
                
                return $data;
        } 
}  


function addCustomerSurvey(){

    $form_data = array(
        ':full_names'  => $_POST["full_names"],
        ':cellphone'  => $_POST["cellphone"],
        ':region'  => $_POST["region"],
        ':quality'  => $_POST["quality"], 
        ':time'  => $_POST["time"], 
        ':communication'  => $_POST["communication"], 
        ':experience'  => $_POST["experience"], 
        ':friendliness'  => $_POST["friendliness"], 
        ':resolving_issues'  => $_POST["resolving_issues"], 
        ':notes'  => $_POST["notes"]
    );

    $query = "
    INSERT INTO customer_experience_tbl 
    (full_names, cellphone, region, quality, time, communication, experience, friendliness, resolving_issues, notes) 
    VALUES 
    (:full_names, :cellphone, :region, :quality, :time, :communication, :experience, :friendliness, :resolving_issues, :notes)
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

function getSurveysDone(){
    $query = "SELECT * FROM customer_experience_tbl ORDER BY experience_id DESC";
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

function showCustomerExpirience($region)
{
 $query = "
 SELECT 
 ( SELECT AVG(quality) FROM customer_experience_tbl WHERE region='".$region."' ) AS average_quality, 
 ( SELECT AVG(time) FROM customer_experience_tbl WHERE region='".$region."' ) AS average_time, 
 ( SELECT AVG(communication) FROM customer_experience_tbl WHERE region='".$region."' ) AS average_communication, 
 ( SELECT AVG(experience) FROM customer_experience_tbl WHERE region='".$region."' ) AS average_experience, 
 ( SELECT AVG(friendliness) FROM customer_experience_tbl WHERE region='".$region."' ) AS average_friendliness, 
 ( SELECT AVG(resolving_issues) FROM customer_experience_tbl WHERE region='".$region."' ) AS average_resolving_issues;
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

}
?>
