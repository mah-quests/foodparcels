<?php

class BeneficiaryDetailsClass
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

   function addNonFoodbankStaffMember(){

    $form_data = array(
        ':unique_code'  => $_POST["unique_code"],
        ':region'  => $_POST["region"],
        ':official_name'  => $_POST["official_name"],
        ':referral_contact'  => $_POST["referral_contact"],
        ':date_reffered'  => $_POST["date_reffered"],
        ':referral_department'  => $_POST["referral_department"]
    );

    $query = "
    INSERT INTO non_foodbank_staff_tbl 
    (unique_code, region, official_name, referral_contact, date_reffered, referral_department) 
    VALUES 
    (:unique_code, :region, :official_name, :referral_contact, :date_reffered, :referral_department)
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


    function addHeadOfHousehold(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':first_name'  => $_POST["first_name"],
            ':surname'  => $_POST["surname"],
            ':id_number'  => $_POST["id_number"],
            ':region'  => $_POST["region"],
            ':cellphone'  => $_POST["cellphone"],
            ':head_grant_type'  => $_POST["head_grant_type"],
            ':home_address'  => $_POST["home_address"],
            ':ward_number'  => $_POST["ward_number"],
            ':ward_code'  => $_POST["ward_code"],
            ':suburb'  => $_POST["suburb"],
            ':district'  => $_POST["district"],
            ':municipality'  => $_POST["municipality"],
            ':other_help'  => $_POST["other_help"],
            ':made_payment'  => $_POST["made_payment"],
            ':paid_who'  => $_POST["paid_who"],
            ':by_official'  => $_POST["by_official"],
            ':specify_other'  => $_POST["specify_other"]
        );
    
        $query = "
        INSERT INTO head_of_household_tbl 
        (unique_code, first_name, surname, id_number, region, cellphone, head_grant_type, home_address, ward_number, ward_code, suburb, district, municipality, other_help, made_payment, paid_who, by_official, specify_other) 
        VALUES 
        (:unique_code, :first_name, :surname, :id_number, :region, :cellphone, :head_grant_type, :home_address, :ward_number, :ward_code, :suburb, :district, :municipality, :other_help, :made_payment, :paid_who, :by_official, :specify_other)
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



    function addHouseholdDetails(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':region'  => $_POST["region"],
            ':household_status'  => $_POST["household_status"],
            ':ailments_mobilities'  => $_POST["ailments_mobilities"],
            ':household_affected'  => $_POST["household_affected"],
            ':no_sa_id'  => $_POST["no_sa_id"],
            ':no_sa_passport'  => $_POST["no_sa_passport"],
            ':no_birth_certificate'  => $_POST["no_birth_certificate"],
            ':country_of_origin'  => $_POST["country_of_origin"],
            ':no_other_country_id'  => $_POST["no_other_country_id"],
            ':no_other_country_passport'  => $_POST["no_other_country_passport"],
            ':household_employed'  => $_POST["household_employed"],
            ':school_upto_grade12'  => $_POST["school_upto_grade12"],
            ':people_need_skills'  => $_POST["people_need_skills"],
            ':earnings_income'  => $_POST["earnings_income"],
            ':earnings_grant'  => $_POST["earnings_grant"],
            ':earnings_other'  => $_POST["earnings_other"]
        );
    
        $query = "
        INSERT INTO household_details_tbl 
        (unique_code, region, household_status, ailments_mobilities, household_affected, no_sa_id, no_sa_passport, no_birth_certificate, country_of_origin, no_other_country_id, no_other_country_passport, household_employed, school_upto_grade12, people_need_skills, earnings_income, earnings_grant, earnings_other) 
        VALUES 
        (:unique_code, :region, :household_status, :ailments_mobilities, :household_affected, :no_sa_id, :no_sa_passport, :no_birth_certificate, :country_of_origin, :no_other_country_id, :no_other_country_passport, :household_employed, :school_upto_grade12, :people_need_skills, :earnings_income, :earnings_grant, :earnings_other)
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


    function addBeneficiaryDetails(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':name'  => $_POST["name"],
            ':surname'  => $_POST["surname"],
            ':id_number'  => $_POST["id_number"],
            ':relation'  => $_POST["relation"],
            ':grant_type'  => $_POST["grant_type"],
            ':gender'  => $_POST["gender"],
            ':disabled'  => $_POST["disabled"],
            ':region'  => $_POST["region"]            
        );
    
        $query = "
        INSERT INTO beneficiary_tbl 
        (unique_code, name, surname, id_number, relation, grant_type, gender, disabled, region) 
        VALUES 
        (:unique_code, :name, :surname, :id_number, :relation, :grant_type, :gender, :disabled, :region)
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


    function addChangeAgentDetails(){

            $form_data = array(
                ':unique_code'  => $_POST["unique_code"],
                ':name'  => $_POST["name"],
                ':needs'  => $_POST["needs"],
                ':highest_skills'  => $_POST["highest_skills"],
                ':contactnumber'  => $_POST["contactnumber"],
                ':area'  => $_POST["area"],
                ':workexperience'  => $_POST["workexperience"],
                ':careerpath'  => $_POST["careerpath"],
                ':region'  => $_POST["region"]            
            );
        
            $query = "
            INSERT INTO change_agent_tbl 
            (unique_code, name, needs, highest_skills, contactnumber, area, workexperience, careerpath, region) 
            VALUES 
            (:unique_code, :name, :needs, :highest_skills, :contactnumber, :area, :workexperience, :careerpath, :region)
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
    
    function addDevelopmentOfficer(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':dev_officer_name'  => $_POST["dev_officer_name"],
            ':dev_officer_cellphone'  => $_POST["dev_officer_cellphone"],
            ':nearest_stakeholder'  => $_POST["nearest_stakeholder"],
            ':social_intervention'  => $_POST["social_intervention"],
            ':region'  => $_POST["region"]            
        );
    
        $query = "
        INSERT INTO development_officer_tbl 
        (unique_code, dev_officer_name, dev_officer_cellphone, nearest_stakeholder, social_intervention, region) 
        VALUES 
        (:unique_code, :dev_officer_name, :dev_officer_cellphone, :nearest_stakeholder, :social_intervention, :region)
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

   function getAllHeadOfHouseholds($region)
   {
    $query = "SELECT * FROM head_of_household_tbl WHERE region='".$region."'  ORDER BY hoh_id DESC LIMIT 200";
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

   function getHeadOfHouseholdByCode($code)
   {
    $query = "SELECT * FROM head_of_household_tbl WHERE allocated_ref='".$code."'  ORDER BY hoh_id DESC LIMIT 200";
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

   function getAllHeadOfHouseholdsTop20($region){

    $query = "SELECT * FROM head_of_household_tbl WHERE region='".$region."'  ORDER BY hoh_id DESC LIMIT 20";

        $statement = $this->connect->prepare($query);
        
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
                }
                return $data;
        }
    }


    function getNonFoodbankStaffDetails($code){

        $query = "SELECT * FROM non_foodbank_staff_tbl WHERE unique_code='".$code."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    


    function getHeadOfHouseHoldDetails($code){

        $query = "SELECT * FROM head_of_household_tbl WHERE unique_code='".$code."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    
    
    function showBeneficiaryListByCode($code){

        $query = "SELECT * FROM beneficiary_tbl WHERE unique_code='".$code."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }    
    
    function showHouseholdDetailsByCode($code){

        $query = "SELECT * FROM household_details_tbl WHERE unique_code='".$code."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }        

    function showChangeAgentListByCode($code){

        $query = "SELECT * FROM change_agent_tbl WHERE unique_code='".$code."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }   
    

    function showDevelopmentOfficerByCode($code){

        $query = "SELECT * FROM development_officer_tbl WHERE unique_code='".$code."'";
    
            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }       

    function generateFoodDistributionPlan($suburb, $no_of_dists){

        $query = "SELECT * FROM head_of_household_tbl WHERE suburb='".$suburb."' AND no_delivery_times < 4 order by hoh_date_time ASC limit $no_of_dists";

            $statement = $this->connect->prepare($query);
            
            if($statement->execute()){
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                    }
                    
                    return $data;
            }
    }  
    
    
    function updateHeadHouseholdState(){

        $form_data = array(
            ':allocated'  => $_POST["allocated"],
            ':allocated_ref'  => $_POST["allocated_ref"],
            ':hoh_id'  => $_POST["hoh_id"]
        );

        $query = "
        UPDATE head_of_household_tbl 
        SET 
            allocated = :allocated,
            allocated_ref = :allocated_ref

        WHERE hoh_id = :hoh_id
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
    

    function addPlannedRoute(){

        $form_data = array(
            ':unique_code'  => $_POST["unique_code"],
            ':day'  => $_POST["day"],
            ':route_gen_date'  => $_POST["route_gen_date"],
            ':region'  => $_POST["region"],
            ':suburb'  => $_POST["suburb"],
            ':user_id'  => $_POST["user_id"],
            ':performed_by'  => $_POST["performed_by"]
        );
    
        $query = "
        INSERT INTO distribution_route_tbl 
        (unique_code, day, route_gen_date, region, suburb, user_id, performed_by) 
        VALUES 
        (:unique_code, :day, :route_gen_date, :region, :suburb, :user_id, :performed_by)
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
        
        function showDistributionRoutes($region)
        {
         $query = "SELECT * FROM distribution_route_tbl WHERE region='".$region."'  ORDER BY distr_route_id DESC LIMIT 200";
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
        
        function showDistributionRoutesLimit($region)
        {
         $query = "SELECT * FROM distribution_route_tbl WHERE region='".$region."'  ORDER BY distr_route_id DESC LIMIT 7";
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

        function showBeneficiaryStages($region)
        {
         $query = "
         SELECT 
         ( SELECT COUNT(*) FROM head_of_household_tbl WHERE allocated='new' AND region='".$region."' ) AS tot_new_users, 
         ( SELECT COUNT(*) FROM head_of_household_tbl WHERE allocated='delivered' AND region='".$region."') AS tot_delivered_users, 
         ( SELECT COUNT(*) FROM head_of_household_tbl WHERE allocated='post-delivery' AND region='".$region."') AS tot_completed_users;
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

        function showVariousSuburbs($region)
        {
         $query = "SELECT DISTINCT(suburb) FROM head_of_household_tbl WHERE region='".$region."'";
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

        function getNewHeadOfHouseholdsTop20($region){

            $query = "SELECT * FROM head_of_household_tbl WHERE region='".$region."' AND allocated='new'  ORDER BY hoh_id DESC LIMIT 20";
        
                $statement = $this->connect->prepare($query);
                
                if($statement->execute()){
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $data[] = $row;
                        }
                        return $data;
                }
        } 


        function getDeliveredHeadOfHouseholdsTop20($region){

            $query = "SELECT * FROM head_of_household_tbl WHERE region='".$region."' AND allocated='delivered'  ORDER BY hoh_id DESC LIMIT 20";
        
                $statement = $this->connect->prepare($query);
                
                if($statement->execute()){
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $data[] = $row;
                        }
                        return $data;
                }
        }    
        

        function getPostDeliveredHeadOfHouseholdsTop20($region){

            $query = "SELECT * FROM head_of_household_tbl WHERE region='".$region."' AND allocated='post-delivery'  ORDER BY hoh_id DESC LIMIT 20";
        
                $statement = $this->connect->prepare($query);
                
                if($statement->execute()){
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $data[] = $row;
                        }
                        return $data;
                }
        }           
        
        function countNumberOfBeneficiaries($code)
        {
         $query = "SELECT COUNT(*) as total_beneficiaries FROM beneficiary_tbl WHERE unique_code='".$code."'";
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
