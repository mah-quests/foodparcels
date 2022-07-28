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
      $this->connect = new PDO("mysql:host=localhost;dbname=foodbank", "foodbank", "foodbank");
      
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
        ':code'  => $_POST["code"]
    );

    $query = "
    INSERT INTO user_login_tbl 
    (first_name, surname, username, password, role, region, foodbank, code) 
    VALUES 
    (:first_name, :surname, :username, :password, :role, :region, :foodbank, :code)
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


}

?>
