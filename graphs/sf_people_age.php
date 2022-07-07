<?php

if ($project == 'solidarity'){
    $numberOfMales = $totalSFNumberOfMales;
    $numberOfFemales = $totalSFNumberOfFemales;
    $numberOfIntersex = $totalSFNumberOfHomoSex;
    $numberOfOtherSex = $totalSFNumberOfOtherSex;
    $numberOfPeople = $totalSFNumberOfPeople;
    $numberOfAges0_13 = $totalSFAges0_13;
    $numberOfAges14_18 = $totalSFAges14_18;
    $numberOfAges19_35 = $totalSFAges19_35;
    $numberOfAges36_59 = $totalSFAges36_59;
    $numberOfAges60Plus = $totalSFAges60Plus;

}


?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawSexComposition);
      google.charts.setOnLoadCallback(ageSegmentation);

      function drawSexComposition() {


        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sex');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Females', <?php echo $numberOfFemales; ?>],
          ['Males', <?php echo $numberOfMales; ?>],
          ['Intersex', <?php echo $numberOfIntersex; ?>],
          ['Others', <?php echo $numberOfOtherSex; ?>],
          ['Others', 0]
        ]);

        var options = {title:'Total Number of household people: <?php echo $numberOfPeople; ?>',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('SexComposition_chart_div'));
        chart.draw(data, options);
      }

      function ageSegmentation() {
        var data = google.visualization.arrayToDataTable([
          ['Age Groupings', '#'],
          ['0 to 13 years', <?php echo $numberOfAges0_13; ?>],
          ['14 to 18 years', <?php echo $numberOfAges14_18; ?>],
          ['19 to 35 years', <?php echo $numberOfAges19_35; ?>],
          ['36 to 59 years', <?php echo $numberOfAges36_59 ?>],
          ['Older than 60 years', <?php echo $numberOfAges60Plus ?>]
        ]);

        var options = {
          title: 'Households Age Groupings',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('age_segmentation_pie_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="SexComposition_chart_div" style="border: 0px solid #ccc"></div></td>
        <td><div id="age_segmentation_pie_chart" style="width: 600px; height: 400px;"></div></td>
      </tr>
    </table>
  </body>
</html>
