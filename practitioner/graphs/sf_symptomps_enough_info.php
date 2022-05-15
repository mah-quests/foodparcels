
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawSymptomsKnown);
      google.charts.setOnLoadCallback(drawReceivingInfomation);

      function drawSymptomsKnown() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sex');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Knows 4 and more symptoms', <?php echo $numberOfSymptoms4Plus; ?>],
          ['Knows 2 aand more symptoms', <?php echo $numberOfSymptoms2Plus; ?>],
          ['Only knows 1 symptom or none at all', <?php echo $numberOfSymptoms1orZero; ?>]
        ]);

        var options = {title:'Number of people who know the general list of COVID symptoms... ',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('symptoms_knowledge_chart_div'));
        chart.draw(data, options);
      }

      function drawReceivingInfomation() {
        var data = google.visualization.arrayToDataTable([
          ['Level of Covid infomation', '#'],
          ['Has received sufficient infomation', <?php echo $yesEnoughCovidInfo; ?>],
          ['Have access to some information', <?php echo $somewhatEnoughCovidInfo; ?>],
          ['Do not have information about COVID', <?php echo $notEnoughCovidInfo; ?>]
        ]);

        var options = {
          title: 'Number of people who have received enough communication on COVID-19',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('receiving_info_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="symptoms_knowledge_chart_div" style="border: 0px solid #ccc"></div></td>
        <td><div id="receiving_info_chart" style="width: 600px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
