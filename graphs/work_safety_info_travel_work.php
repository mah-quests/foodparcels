<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawTransportMode);
      google.charts.setOnLoadCallback(drawPreventionMeasures);

      function drawPreventionMeasures() {
        var data = google.visualization.arrayToDataTable([
          ['Prevention measures', 'Responses'],
          ['COVID-19 Manager onsite', <?php echo $numOfKnownWorkplaceGuidelines ?> ],
          ['Daily temperature checks for all staff', <?php echo $numOfUnKnownWorkplaceGuidelines ?> ],
          ['Changed policies for sick leave', <?php echo $numOfSomeKnownWorkplaceGuidelines ?> ]
        ]);

        var options = {
          title: 'measures taken by employer',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('prevention_measures_charts'));
        chart.draw(data, options);
      }

      function drawTransportMode() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Own car', <?php echo $numOfOwnCarWorkTravel ?>],
          ['Car pool', <?php echo $numOfCarPoolWorkTravel ?>],
          ['Minibus Taxi', <?php echo $numOfMinibusTaxiWorkTravel ?>],
          ['Bus', <?php echo $numOfBusTaxiWorkTravel ?>],
          ['Train', <?php echo $numOfTrainWorkTravel ?>],
          ['High Speed Rail', <?php echo $numOfHighSpeedWorkTravel ?>],
          ['Uber/ Taxify', <?php echo $numOfUberTaxifyWorkTravel ?>],
          ['Other', <?php echo $numOfOtherWorkTravel ?>]
        ]);

        // Set options for Sarah's pie chart.
        var overall_totals_options = {
                      title:'How do you travel to work',
                       width:600,
                       height:400,
                       legend: 'none',
                       colors: ['#3366CC']
                     };

      
        var overall_totals_barchart = new google.visualization.BarChart(document.getElementById('mode_of_transport_charts'));
        overall_totals_barchart.draw(data, overall_totals_options);
      }

    </script>
  </head>
  <body>

    <table class="columns">
      <tr>
        <td>
          <div id="prevention_measures_charts" style="width: 500px; height: 400px;"></div>
        </td>
        <td>
          <div id="mode_of_transport_charts" style="width: 800px; height: 400px;">
        </td>                
      </tr>
    </table>
 
  </body>
</html>