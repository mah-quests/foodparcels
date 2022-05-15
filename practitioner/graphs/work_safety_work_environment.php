
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawSafeWorkEnvironment);
      google.charts.setOnLoadCallback(drawWorkCOVIDMeasurements);

      function drawSafeWorkEnvironment() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Working environment');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Working environment safe against COVID: Yes', <?php echo $numOfYesSafeWorkplace; ?>],
          ['Working environment safe against COVID: No', <?php echo $numOfNoSafeWorkplace; ?>],
          ['Working environment safe against COVID: Somewhat', <?php echo $numOfSomewhatSafeWorkplace; ?>]
        ]);

        var options = {title:'Has your employer taken any steps to make your working environment safe against COVID infection',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('safe_work_env_chart_div'));
        chart.draw(data, options);
      }

      function drawWorkCOVIDMeasurements() {
        var data = google.visualization.arrayToDataTable([
          ['Measurements taken by the employer', '#'],
          ['COVID-19 Manager onsite', <?php echo $numOfCOVIDManager; ?>],
          ['Daily temperature checks for all staff', <?php echo $numOfDailyTemperatureChecks; ?>],
          ['Changed policies for sick leave', <?php echo $numOfChangedPolicies; ?>]
        ]);

        var options = {
          title: 'Number of people who have received enough communication on COVID-19',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('work_covid_measurements_info_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="safe_work_env_chart_div" style="border: 0px solid #ccc"></div></td>
        <td><div id="work_covid_measurements_info_chart" style="width: 600px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
