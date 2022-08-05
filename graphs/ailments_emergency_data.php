
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawSexGraphs);
      google.charts.setOnLoadCallback(drawPronounGraphs);

      function drawSexGraphs() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Ailments');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Old Age', <?php echo 5645; ?>],
          ['Not Mobile', <?php echo 8973; ?>],
          ['Disabled', <?php echo 342; ?>],
          ['Substance Abuse', <?php echo 1134; ?>],
          ['None', <?php echo 453; ?>]
        ]);

        var options = {title:'Ailments Addictions & Mobility',
                       width:500,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('sex_chart_div'));
        chart.draw(data, options);
      }

      function drawPronounGraphs() {
        var data = google.visualization.arrayToDataTable([
          ['Emergency Type', '#'],
          ['Burnt Shack', <?php echo 8643; ?>],
          ['Flood', <?php echo 453; ?>],
          ['Tonando/ Wind', <?php echo 5647; ?>],
          ['Funeral', <?php echo 345; ?>],
          ['Other', <?php echo 453; ?>]
        ]);

        var options = {title:'Emergency: households affected',
                       width:500,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('pronouns_chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="sex_chart_div" style="border: 0px solid #ccc"></div></td>
        <td><div id="pronouns_chart_div" style="width: 600px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
