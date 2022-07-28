<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawVisibleMeasures);
      function drawVisibleMeasures() {
        var data = google.visualization.arrayToDataTable([
          ['Grant', '#'],
          ['Passengers sanitised at entry', <?php echo $numOfSanitisedAtEntry ?>],
          ['Passengers wearing masks', <?php echo $numOfSanitisedAtEntry ?>],
          ['The driver wearing a mask',  <?php echo $numOfDriverWearingMask ?>],
          ['Window open', <?php echo $numOfWindowOpen ?>],
          ['Atleast 1 space between passengers', <?php echo $numOf1Space ?>]
        ]);

        var options = {
          title: 'Are there safety measures that you can see',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('visible_measure_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="visible_measure_chart" style="width: 1200px; height: 500px;"></div>
  </body>
</html>