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
          ['Better', <?php echo $numOfBetterHealthImprovements ?> ],
          ['The same', <?php echo $numOfTheSameHealthImprovements ?> ],
          ['Worse', <?php echo $numOfWorseHealthImprovements ?> ],
          ['Not sure ', <?php echo $numOfNotSureHealthImprovements ?>]
        ]);

        var options = {
          title: 'as compared to last year your health is: ',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('gender_identity_charts'));
        chart.draw(data, options);
      }

      function drawGenderGraphs() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Much less', <?php echo $numOfMuchLessDailyMeals ?>],
          ['Less', <?php echo $numOfLessDailyMeals ?>],
          ['The same', <?php echo $numOfTheSameDailyMeals ?>],
          ['More', <?php echo $numOfMoreDailyMeals ?>],
          ['Much more', <?php echo $numOfMuchMoreDailyMeals ?>]
        ]);

        // Set options for Sarah's pie chart.
        var overall_totals_options = {
                      title:'Been able to eat a daily meal since the beginning of lockdown:',
                       width:600,
                       height:400,
                       legend: 'none',
                       colors: ['#cdcdca']
                     };

      
        var overall_totals_barchart = new google.visualization.BarChart(document.getElementById('gender_charts'));
        overall_totals_barchart.draw(data, overall_totals_options);
      }

    </script>
  </head>
  <body>

    <table class="columns">
      <tr>
        <td>
          <div id="gender_identity_charts" style="width: 500px; height: 400px;"></div>
        </td>
        <td>
          <div id="gender_charts" style="width: 800px; height: 400px;">
        </td>                
      </tr>
    </table>
 
  </body>
</html>