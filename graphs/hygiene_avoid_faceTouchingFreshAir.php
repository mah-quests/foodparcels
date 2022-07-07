
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawAvoidTouchingGraph);
      google.charts.setOnLoadCallback(drawFreshAirGraph);

      function drawAvoidTouchingGraph() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sex');
        data.addColumn('number', 'Numbers');
        data.addRows([
            ['Avoid Touching face throughout the Day', <?php echo $numOfAvoidTouchingFaceThroughDay ?> ],
          ['Avoid Touching face Daily', <?php echo $numOfAvoidTouchingFaceDaily?> ],
          ['Avoid Touching face few times a week', <?php echo $numOfAvoidTouchingFaceFewTimesWeek ?> ],
          ['Avoid Touching face Weekly', <?php echo $numOfAvoidTouchingFaceWeekly ?>],
          ['Avoid Touching face 3-times month', <?php echo $numOfAvoidTouchingFace3TimesMonth ?>],
          ['Never Avoid Touching face ', <?php echo $numOfAvoidTouchingFaceNever ?>]
        ]);

        var options = {title:'Avoid touching face:',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('avoidTouching_face_chart'));
        chart.draw(data, options);
      }

      function drawFreshAirGraph() {
        var data = google.visualization.arrayToDataTable([
          ['Pronouns', '#'],
          ['Increased Fresh Air throughout the Day', <?php echo $numOfFreshAirThroughDay ?>],
          ['Increased Fresh Air Daily', <?php echo $numOfFreshAirDaily ?>],
          ['Increased Fresh Air few times a week', <?php echo $numOfFreshAirFewTimesWeek ?>],
          ['Increased Fresh Air Weekly', <?php echo $numOfFreshAirWeekly ?>],
          ['Increased Fresh Air 3-times month', <?php echo $numOfFreshAir3TimesMonth ?>],
          ['Never increase amount if fresh air', <?php echo $numOfFreshAirNever ?>]
        ]);

        var options = {title:'Increased the amount of fresh air',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('fresh_air_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="avoidTouching_face_chart" style="border: 0px solid #ccc"></div></td>
        <td><div id="fresh_air_chart" style="width: 600px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
