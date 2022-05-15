
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawAgentsRegistrations);

      function drawAgentsRegistrations() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['#', 'Active Agents Today', 'Gauteng Stats', 'Eastern Cape Stats', 'Average', 'KZN Stats', 'Western Cape Stats'],
          ['today',  <?php echo $totalSFTodayActiveAgents; ?> , <?php echo $totalSFTodayGautengSurveys; ?> , <?php echo $totalSFTodayEasternCapeSurveys; ?>, <?php echo $avgSFTodayCrossCountrySurveys; ?>, <?php echo $totalSFTodayKZNSurveys; ?>, <?php echo $totalSFTodayWesternCapeSurveys; ?> ],
          ['yesterday',  <?php echo $totalSFYesterdayActiveAgents; ?> , <?php echo $totalSFYesterdayGautengSurveys; ?> , <?php echo $totalSFYesterdayEasternCapeSurveys; ?>, <?php echo $avgSFYesterdayCrossCountrySurveys; ?>, <?php echo $totalSFYesterdayKZNSurveys; ?>, <?php echo $totalSFYesterdayWesternCapeSurveys; ?> ]
        ]);

        var options = {
          title : 'Stats for the past 2 days on Solidarity Fund Project Activities',
          vAxis: {title: 'Provincial Activities'},
          hAxis: {title: 'Today Stats'},
          seriesType: 'bars',
          series: {3: {type: 'line'}}        
        };

        var chart = new google.visualization.ComboChart(document.getElementById('draw_chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="draw_chart_div" style="width: 1100px; height: 500px;"></div>
  </body>
</html>