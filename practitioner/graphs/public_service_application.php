<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawGenderGraphs);
      google.charts.setOnLoadCallback(drawAppliedUnemploymentAssistance);

      function drawAppliedUnemploymentAssistance() {
        var data = google.visualization.arrayToDataTable([
          ['Household', 'Responses'],
          ['Applied for unemployment assistance: Yes', <?php echo $numOfYesAppliedAssistance ?> ],
          ['Applied for unemployment assistance: No', <?php echo $numOfNoAppliedAssistance ?> ],
          ['Applied for unemployment assistance: Unsure', <?php echo $numOfUnsureAppliedAssistance ?> ]
        ]);

        var options = {
          title: 'If you lost your job during Covid, have you applied for unemployment assistance',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('unemployment_assistance_charts'));
        chart.draw(data, options);
      }

      function drawGenderGraphs() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Application Success: Yes', <?php echo $numOfYesApplicationSuccess ?>],
          ['Application Success: No', <?php echo $numOfNoApplicationSuccess ?>],
          ['Application Success: Unsure', <?php echo $numOfUnsureApplicationSuccess ?>]
        ]);

        // Set options for Sarah's pie chart.
        var overall_totals_options = {
                      title:'Number of applications made: <?php echo $numOfYesAppliedAssistance ?>',
                       width:600,
                       height:400,
                       legend: 'none',
                       colors: ['#3366CC']
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
          <div id="unemployment_assistance_charts" style="width: 500px; height: 400px;"></div>
        </td>
        <td>
          <div id="gender_charts" style="width: 800px; height: 400px;">
        </td>                
      </tr>
    </table>
 
  </body>
</html>