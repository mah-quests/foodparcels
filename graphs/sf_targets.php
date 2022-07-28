<?php

        $agent_overall_target = 200;
        $agent_daily_target = 10;
        $overArchiveToday = 0;
        $overArchiveOverall = 0;
        $outstandingToday = 0;


        $sql="select * from users_orders where u_id = '".$_SESSION["user_id"]."' and date(date) = curdate()";
            $result=mysqli_query($db,$sql);
            $totalHouseholdsDoneToday=mysqli_num_rows($result);


        $sql="select * from users_orders where u_id = '".$_SESSION["user_id"]."' ";
            $result=mysqli_query($db,$sql);
            $totalHouseholdsDoneOverall=mysqli_num_rows($result);


        $outstandingToday = $agent_daily_target - $totalHouseholdsDoneToday;
        $outstandingOverall = $agent_overall_target - $totalHouseholdsDoneOverall;


       if($outstandingToday < 0 ){
           $overArchiveToday = 0 - ($outstandingToday);
           $outstandingToday = 0;
       }

        if($outstandingOverall < 0 ){
            $overArchiveOverall = 0 - ($outstandingOverall);
            $outstandingOverall = 0;
        }



?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawDailyActivities);
      google.charts.setOnLoadCallback(drawOverallActivities);

      function drawDailyActivities() {

          var data = google.visualization.arrayToDataTable([
            ["Today", "#", { role: "style" } ],
            ["Today Target", <?php echo $agent_daily_target ?>, "#03bc03"],
            ["Surveys Done Today", <?php echo $totalHouseholdsDoneToday ?>, "447eba"],
            ["Outstanding Surveys Today", <?php echo $outstandingToday ?>, "fc0e00"],
            ["Today over achieved surveys", <?php echo $overArchiveToday ?>, "color: #f9bc02"]
          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options = {
            title: "Survey and Stats done today",
            width: 800,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.BarChart(document.getElementById("daily_chart_div"));
          chart.draw(view, options);

      }

      function drawOverallActivities() {

          var data = google.visualization.arrayToDataTable([
            ["Overall", "#", { role: "style" } ],
            ["Overall Target", <?php echo $agent_overall_target ?>, "#03bc03"],
            ["Surveys Done So Far", <?php echo $totalHouseholdsDoneOverall ?>, "447eba"],
            ["Outstanding Surveys So Far", <?php echo $outstandingOverall ?>, "fc0e00"],
            ["Over achieved surveys", <?php echo $overArchiveOverall ?>, "color: #f9bc02"]
          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options = {
            title: "Overall Surveys and Stats done up-to-date",
            width: 700,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.BarChart(document.getElementById("overall_chart_div"));
          chart.draw(view, options);
      }
    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td><div id="daily_chart_div" style="width: 800px; height: 400px;"></div></td>
        <td><div id="overall_chart_div" style="width: 700px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>

