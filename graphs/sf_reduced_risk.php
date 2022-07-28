
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawAgentReviews);

      function drawAgentReviews() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Yes', 'No Response','No'],
          ['Yes - Responses', <?php echo $totalSPYesReducedRisk ?>, 0, 0],
          ['No - Responses', 0, <?php echo $totalSPNoReducedRisk ?>, 0]
        ]);

        var options = {
          chart: {
            title: 'Respondents belief to risk of contracting the virus',
            subtitle: 'since the announcement of the easing of the lockdown regulations',
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 500,
          colors: ['#119618', '#feaa00', '#fc0e00']
        };

        var chart = new google.charts.Bar(document.getElementById('agents_reviews_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        btns.onclick = function (e) {

          if (e.target.tagName === 'BUTTON') {
            options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        }
      }
    </script>
  </head>
  <body>
    <div id="agents_reviews_div" style="width: 1100px; height: 550px;"></div>
  </body>
</html>