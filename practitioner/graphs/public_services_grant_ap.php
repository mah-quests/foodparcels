<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Grant', '#'],
          ['Old persons Grant', <?php echo $numOfOldPersonsGrant ?>],
          ['Disability Grant', <?php echo $numOfDisabilityGrant ?>],
          ['Care-Dependency Grant',  <?php echo $numOfCareDependencyGrant ?>],
          ['War Veterans Grant', <?php echo $numOfWarVeteranGrant ?>],
          ['Child Support Grant', <?php echo $numOfChildSupportGrant ?>],
          ['Foster Child Grant', <?php echo $numOfFosterChildGrant ?>],
          ['Grant-in-Aid', <?php echo $numOfInAidGrant ?>]
        ]);

        var options = {
          title: 'Which grant did people apply for',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 1200px; height: 500px;"></div>
  </body>
</html>