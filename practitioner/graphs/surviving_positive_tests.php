
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawHospitalizedStats);
      google.charts.setOnLoadCallback(isolationSegmentations);

      function drawHospitalizedStats() {


        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Hospitalized');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['# People Hospitalized', <?php echo $numOfYesHospitalised; ?>],
          ['# People Did Not Hospitalize', <?php echo $numOfNoHospitalised; ?>]
        ]);

        var options = {title:'Total Number of people tested positive: <?php echo $numOfYesTestedPositive; ?>',
                       width:800,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('hospitalized_chart_div'));
        chart.draw(data, options);
      }

      function isolationSegmentations() {
        var data = google.visualization.arrayToDataTable([
          ['Isolated', '#'],
          ['Isolated in my own household', <?php echo $numOfIsolatedHousehold; ?>],
          ['Isolated in a separate dwelling outside of my usual house', <?php echo $numOfIsolatedOutside; ?>],
          ['I did not self-isolate', <?php echo $numOfDidNotIsolate ?>]
        ]);

        var options = {
          title: 'Isolation Details',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('isolation_segmentation_pie_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="hospitalized_chart_div" style="border: 0px solid #ccc"></div></td>
        <td><div id="isolation_segmentation_pie_chart" style="width: 400px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
