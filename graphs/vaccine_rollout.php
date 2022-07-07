
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawtVaccineRolloutChart);
      function drawtVaccineRolloutChart() {
        var data = google.visualization.arrayToDataTable([
          ['Access to water & sanitation', '#'],
          ['Strongly Agree', <?php echo $numOfQuicklyAsPossibleSAgree ?>],
          ['Agree',  <?php echo $numOfQuicklyAsPossibleAgree ?>],
          ['Neither Agree nor Diagree', <?php echo $numOfQuicklyAsPossibleNutral ?>],
          ['Disagree', <?php echo $numOfQuicklyAsPossibleDisagree ?>],
          ['Strongly Disagree', <?php echo $numOfQuicklyAsPossibleSDisagree ?>]                    
        ]);

        var options = {
          title: 'South Africa should roll out vaccines to the population as quickly as possible?',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('vaccine_rollout'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="vaccine_rollout" style="width: 1200px; height: 500px;"></div>
  </body>
</html>