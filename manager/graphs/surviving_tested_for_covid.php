
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Testing', '#'],
          ['Yes', <?php echo $numOfYesTestedPositive ?>],
          ['No',  <?php echo $numOfNoTestedPositive ?>],
          ['Unsure', <?php echo $numOfUnsureTestedPositive ?>]
        ]);

        var options = {
          title: 'Number of candidates tested for Covid-19: <?php echo $totalNumberOfTests ?>',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 1200px; height: 500px;"></div>
  </body>
</html>