
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Access to water & sanitation', '#'],
          ['Public community access points', <?php echo $numOfCommunityAccessPoints ?>],
          ['Flushing toilet inside dwelling',  <?php echo $numOfToiletInsideDwelling ?>],
          ['Flushing toilet located outside of dwelling', <?php echo $numOfToiletOutsideDwelling ?>],
          ['Tap with running water inside dwelling', <?php echo $numOfTapInsideDwelling ?>],
          ['Tap with running water outside dwelling', <?php echo $numOfTapOutsideDwelling ?>]                    
        ]);

        var options = {
          title: 'Access to water and sanitation i.e. toilets and running water',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('public_sanitation_services_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="public_sanitation_services_chart" style="width: 1200px; height: 500px;"></div>
  </body>
</html>