<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawPrioritiseTeachers);
      google.charts.setOnLoadCallback(drawPrioritiseHW);

      function drawPrioritiseHW() {
        var data = google.visualization.arrayToDataTable([
          ['Household', 'Responses'],
          ['Strongly Agree', <?php echo $numOfPrioritiseHWSAgree ?> ],
          ['Agree', <?php echo $numOfPrioritiseHWAgree ?> ],
          ['Neither Agree nor Disagree', <?php echo $numOfPrioritiseHWNutral ?> ],
          ['Disagree', <?php echo $numOfPrioritiseHWDisagree ?> ],
          ['Strongly Disagree', <?php echo $numOfPrioritiseHWSDisagree ?> ]
        ]);

        var options = {
          title: 'Health workers should be included as essential workers to be prioritised for the vaccine roll-out',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('prioritise_health_workesrs'));
        chart.draw(data, options);
      }

      function drawPrioritiseTeachers() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Strongly Agree', <?php echo $numOfPrioritiseTeachersSAgree ?> ],
          ['Agree', <?php echo $numOfPrioritiseTeachersAgree ?> ],
          ['Neither Agree nor Disagree', <?php echo $numOfPrioritiseTeachersNutral ?> ],
          ['Disagree', <?php echo $numOfPrioritiseTeachersDisagree ?> ],
          ['Strongly Disagree', <?php echo $numOfPrioritiseTeachersSDisagree ?> ]
        ]);

        // Set options for Sarah's pie chart.
        var overall_totals_options = {
                      title:'Teachers should be included as essential workers to be prioritised for the vaccine roll-out',
                       width:600,
                       height:400,
                       legend: 'none',
                       colors: ['#3366CC']
                     };

      
        var overall_totals_barchart = new google.visualization.BarChart(document.getElementById('prioritise_teachers'));
        overall_totals_barchart.draw(data, overall_totals_options);
      }

    </script>
  </head>
  <body>

    <table class="columns">
      <tr>
        <td>
          <div id="prioritise_health_workesrs" style="width: 500px; height: 400px;"></div>
        </td>
        <td>
          <div id="prioritise_teachers" style="width: 800px; height: 400px;">
        </td>                
      </tr>
    </table>
 
  </body>
</html>