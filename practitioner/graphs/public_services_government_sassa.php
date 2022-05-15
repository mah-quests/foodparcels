
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
        data.addColumn('string', 'Government Support Schemes');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Access any government support schemes: Yes', <?php echo $numOfYesGovernmentSupport; ?>],
          ['Access any government support schemes: No', <?php echo $numOfNoGovernmentSupport; ?>],          
          ['Access any government support schemes: Unsure', <?php echo $numOfUnsureGovernmentSupport; ?>]
        ]);

        var options = {title:'People who accessed any government support schemes',
                       width:500,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('hospitalized_chart_div'));
        chart.draw(data, options);
      }

      function isolationSegmentations() {
        var data = google.visualization.arrayToDataTable([
          ['Sassa', '#'],
          ['Applied For Sassa', <?php echo $numOfYesAppliedSassa; ?>],
          ['Did Not Apply For Sassa', <?php echo $numOfNoAppliedSassa; ?>]
        ]);

        var options = {
          title: 'Applied For Sassa Grant',
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
        <td><div id="isolation_segmentation_pie_chart" style="width: 700px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
