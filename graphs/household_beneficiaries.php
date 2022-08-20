<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawHouseholdBeneficiaries);
      google.charts.setOnLoadCallback(drawHeadOfHousehold);
      function drawHeadOfHousehold() {
        var data = google.visualization.arrayToDataTable([
          ['Status of Household', 'Responses'],
          ['Senior Headed', <?php echo 7564 ?> ],
          ['Youth Headed', <?php echo 5643 ?> ],
          ['Child Headed', <?php echo 2532 ?> ],
          ['Child Under 6', <?php echo 1256 ?> ],
          ['Other ', <?php echo 203 ?>]
        ]);

        var options = {
          title: 'Heads of Households',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('heads_households_charts'));
        chart.draw(data, options);
      }

      function drawHouseholdBeneficiaries() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['0', <?php echo 15 ?>],
          ['1 to 5', <?php echo 1323 ?>],
          ['6 to 10', <?php echo 2345 ?>],
          ['11 to 15', <?php echo 702 ?>],
          ['16+', <?php echo 150 ?>]
        ]);

        // Set options for Sarah's pie chart.
        var overall_totals_options = {
                      title:'Number of beneficiaries',
                       width:500,
                       height:400,
                       legend: 'none',
                       colors: ['#DC3912', '#DC3932', '#DC3952', '#DC3A12']
                     };

      
        var overall_totals_barchart = new google.visualization.BarChart(document.getElementById('households_beneficiaries_charts'));
        overall_totals_barchart.draw(data, overall_totals_options);
      }

    </script>
  </head>
  <body>

    <table class="columns">
      <tr>
        <td>
          <div id="heads_households_charts" style="width: 500px; height: 400px;"></div>
        </td>
        <td>
          <div id="households_beneficiaries_charts" style="width: 800px; height: 400px;">
        </td>                
      </tr>
    </table>
 
  </body>
</html>