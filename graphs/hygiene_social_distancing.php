<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawSocialDistancing);
        function drawSocialDistancing() {
          var data = google.visualization.arrayToDataTable([
            ["Difficult Behaviours ", "Numbers", { role: "style" } ],
            ["Social Distancing throughout the Day ",<?php echo $numOfSocialDistanceThroughDay ?>,"#943b6a"],
            ["Social Distancing Daily ", <?php echo $numOfSocialDistanceDaily ?>, "#63008d"],
            ["Social Distancing few times a week ", <?php echo $numOfSocialDistanceFewTimesWeek ?>, "#5600ce"],
            ["Social Distancing weekly", <?php echo $numOfSocialDistanceWeekly ?>, "#717077"],
            ["Social Distancing 3 times in months", <?php echo $numOfSocialDistance3TimesMonth ?>, "#816e60"],
            ["Never Practice Social Distancing", <?php echo $numOfSocialDistanceNever ?>, "#c5ae90"]            
           
          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options = {
            title: " Pactice social Distancing",
            width: 1200,
            height: 400,
            bar: {groupWidth: "90%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.BarChart(document.getElementById("social_distancing_barChart"));
          chart.draw(view, options);
      }
      </script>
    <div id="social_distancing_barChart" style="width: 1100px; height: 400px;"></div>
  </head>
  <body>
  </body>
</html>
