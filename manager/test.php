<?php 

    $APIBASE="http://localhost/foodparcels/api/";
    $_SESSION['region'] = "Johannesburg";
    $current_stock_name = "Maize Meal";
    $row_id = 6;


    if ($current_stock_name == "Maize Meal"){
        $current_stock_name = "Maize+Meal";
    } 

    if ($current_stock_name == "Maize-Meal"){
        $current_stock_name = "Maize+Meal";
    }     

    if ($current_stock_name == "Cooking Oil"){
        $current_stock_name = "Cooking+Oil";
    } 

    if ($current_stock_name == "Baked Beans"){
        $current_stock_name = "Baked+Beans";
    } 

    if ($current_stock_name == "All Purpose Soap"){
        $current_stock_name = "All+Purpose+Soap";
    } 

    if ($current_stock_name == "Soya Mince"){
        $current_stock_name = "Soya+Mince";
    }     

    //Get the current stock level before updating

    $stock_detail_api_url = $APIBASE."delivery_notice_exec.php?action=get_stock_amount&location=".$_SESSION['region']."&stock_name=".$current_stock_name."";

    $client = curl_init($stock_detail_api_url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);

    print_r($result);

    if(count($result) > 0){
        foreach($result as $row) {

            $stock_id = $row->stock_id;
            $current_stock_level = $row->current_stock_level;
            $old_stock_level = $row->old_stock_level;
            $updated_stock_level = $row->updated_stock_level;

            echo "Start".' '.$stock_id." ".$current_stock_level." ".$old_stock_level." ".$updated_stock_level;

        }
    }

    echo "Start".' '.$stock_id." ".$current_stock_level." ".$old_stock_level." ".$updated_stock_level;

    
    $unique_code = $unique_code;
    $received_stock = $new_stock_qty;
    $new_stock_level = $current_stock_level + $received_stock;

    $actual_stock_data = array(
        'unique_code' => $unique_code,
        'current_stock_level' => $new_stock_level,
        'old_stock_level' => $current_stock_level,
        'updated_stock_level' => $received_stock,
        'update_activity' => "Added Fully Stock From The Supplier",
        'stock_id' => $stock_id
    );

    $api_url = $APIBASE."delivery_notice_exec.php?action=update_stock_level";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $actual_stock_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true); 
    
        

?>