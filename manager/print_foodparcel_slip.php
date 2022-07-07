<?php
    include("../config/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Receipt example</title>
    </head>
    <style> 
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 95px;
            max-width: 95px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 80px;
            max-width: 80px;
            word-break: break-all;
            text-align: right;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 180px;
            max-width: 180px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }    
    </style>

    <script type="text/javascript">
      const $btnPrint = document.querySelector("#btnPrint");
      $btnPrint.addEventListener("click", () => {
          window.print();
      });      
    </script>

    <body>
        <div class="ticket">
            <img src="../images/dsd-logo.png" alt="Logo">
            <p class="centered"><b>FOOD PARCEL RECEIPT</b><br>

            <?php
                $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_by_code&code=".$_GET["code"]."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);
                $output_fsq4 = '';

                if(count($result) > 0)
                {
                foreach($result as $row)
                {

            ?>

                <br><b>REFERENCE:</b> <?php echo $row->unique_code ?>
                <br><b>REGION:</b> <?php echo $row->region ?>
                <br><b>PACK DATE:</b> <?php echo substr($row->package_date, 0, 11) ?>
            </p>


            <?php
                }
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="description">Description</th>
                        <th class="price">Exp. Date</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $api_url = $APIBASE."foodpack_exec.php?action=list_foodpack_by_code&code=".$_GET["code"]."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
                    $output = '';

                    if(count($result) > 0)
                    {
                        foreach($result as $row)
                        {

                        $output .= '
                        <tr>
                        <td class="description">'.$row->stock_name.', '. $row->stock_brand.'</td>
                        <td class="price">'.$row->stock_exp_date.'</td>
                        </tr>
                        ';

                        }
                    }

                    echo $output;
                ?>                 

                </tbody>
            </table>

            <div align="center">
                <img src="../qr-code/<?php echo $row->unique_code ?>.png"  alt="QR Code" width="150px" height="150px">
            </div>            

            <br>
            <p class="centered"><i> Buyisa Ubuntu means "Bring back Humanity" </i>
                <br> Developed by www.mahquests.co.za</p>
        </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button id="btnPrint" class="hidden-print">Print</button>
    </body>
</html>