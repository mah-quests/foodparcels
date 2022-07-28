<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawGenderGraphs);
      google.charts.setOnLoadCallback(drawGenderIdentityGraph);
      function drawGenderIdentityGraph() {
        var data = google.visualization.arrayToDataTable([
          ['Household', 'Responses'],
          ['Disinfect throughout the Day', <?php echo $numOfDisinfectSurfacesThroughDay ?> ],
          ['Disinfect Daily', <?php echo $numOfDisinfectSurfacesDaily ?> ],
          ['Disinfect few times a week', <?php echo $numOfDisinfectSurfacesFewTimesWeek ?> ],
          ['Disinfect Weekly', <?php echo $numOfDisinfectSurfacesWeekly ?>],
          ['Disinfect 3-times month', <?php echo $numOfDisinfectSurfaces3TimesMonth ?>],
          ['Never Disinfect Surfaces ', <?php echo $numOfDisinfectSurfacesNever ?>],
        ]);

        var options = {
          title: 'Disinfect Surfaces: ',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('disinfect_surfaces'));
        chart.draw(data, options);
      }

      function drawGenderGraphs() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Disinfect throughout the Day', <?php echo $numOfDisinfectObjectsThroughDay ?>],
          ['Disinfect Daily', <?php echo $numOfDisinfectObjectsDaily ?>],
          ['Disinfect few times a week', <?php echo $numOfDisinfectObjectsFewTimesWeek ?>],
          ['Disinfect Weekly', <?php echo $numOfDisinfectObjectsWeekly ?>],
          ['Disinfect 3-times month', <?php echo $numOfDisinfectObjects3TimesMonth ?>],
          ['Never Disinfect Surfaces', <?php echo $numOfDisinfectObjectsNever ?>]
        ]);

        // Set options for Sarah's pie chart.
        var overall_totals_options = {
                      title:'Clean and disinfect objects you use often such as cellphones, keys etc..',
                       width:600,
                       height:400,
                       legend: 'none',
                       colors: ['#cdcdca']
                     };

      
        var overall_totals_barchart = new google.visualization.BarChart(document.getElementById('disinfect_objects'));
        overall_totals_barchart.draw(data, overall_totals_options);
      }

    </script>
  </head>
  <body>

    <table class="columns">
      <tr>
        <td>
          <div id="disinfect_surfaces" style="width: 500px; height: 400px;"></div>
        </td>
        <td>
          <div id="disinfect_objects" style="width: 800px; height: 400px;">
        </td>                
      </tr>
    </table>
 
  </body>
</html>