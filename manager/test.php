
<?php 

include_once "include/header.php";

    $APIBASE="http://localhost/foodparcels/api/";
    $_SESSION['region'] = "Johannesburg";
    $current_stock_name = "Maize Meal";
    $row_id = 6;
    
        

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <?php
            $api_url = $APIBASE."delivery_notice_exec.php?action=show_foodbank_stock";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            $result = json_decode($response);
            $bank_history_output = '';

            if(count($result) > 0)
            {
            foreach($result as $row)
            {

        ?>
</head>
<body>


            <div class="col-md-6 col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Varying Modal Content</h4>
                  <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ModalLabel">New message</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Recipient:</label>
                              <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">Message:</label>
                              <textarea class="form-control" id="message-text"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success">Send message</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@mdo">Open modal for @mdo</button>
                </div>
              </div>
            </div>

</body>
</html>

<script src="../js/modal-demo.js"></script>

<?php 
            }
        }
?>        