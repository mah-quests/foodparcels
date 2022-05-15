<?php


    $overAllTargets = $overallEveryoneTargets;
    $actualSurveys = $totalSPAllSurveys;
    $overallShotfall = 0;
    if($overAllTargets > $actualSurveys){
      $overallShotfall = $overAllTargets - $actualSurveys;  
    }
    
    $gautengTargets = $overallHousehouldTargetGauteng;
    $actualSurveysGP = $totalSPActualsOverallSurveysGP;
    $overallShotfallGP = 0;
    if($gautengTargets > $actualSurveysGP){
      $overallShotfallGP = $gautengTargets - $actualSurveysGP;
    }

    $ecTargets = $overallHousehouldTargetEC;
    $actualSurveysEC = $totalSPActualsOverallSurveysEC;
    $overallShotfallEC = 0;
    if($ecTargets > $actualSurveysEC){
      $overallShotfallEC = $ecTargets - $actualSurveysEC;
    }    

    $wcTargets = $overallHousehouldTargetWC;
    $actualSurveysWC = $totalSPActualsOverallSurveysWC;
    $overallShotfallWC = 0;
    if($wcTargets > $actualSurveysWC){
      $overallShotfallWC = $wcTargets - $actualSurveysWC;
    }

    $kznTargets = $overallHousehouldTargetKZN;
    $actualSurveysKZN = $totalSPActualsOverallSurveysKZN;
    $overallShotfallKZN = 0;
    if($kznTargets > 0){
      $overallShotfallKZN = $kznTargets - $actualSurveysKZN;
    }         
    

    $projectCompletionPercentage = $actualSurveys / $overAllTargets;

    $finalPercentage = sprintf('%0.2f',$projectCompletionPercentage)


?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawOverallChart);

      function drawOverallChart() {
        var data = google.visualization.arrayToDataTable([
          ['Province', 'Expected', 'Actuals', 'Shortfall'],
          ['Overall Status', <?php echo $overAllTargets ?>, <?php echo $actualSurveys ?>, <?php echo $overallShotfall ?> ],
          ['Gauteng Status', <?php echo $gautengTargets ?>, <?php echo $actualSurveysGP ?>, <?php echo $overallShotfallGP ?> ],
          ['Eastern Cape Status', <?php echo $ecTargets ?>, <?php echo $actualSurveysEC ?>, <?php echo $overallShotfallEC ?>],
          ['Western Cape Status', <?php echo $wcTargets ?>, <?php echo $actualSurveysWC ?>, <?php echo $overallShotfallWC ?>],
          ['KwaZulu Natal Status', <?php echo $kznTargets ?>, <?php echo $actualSurveysKZN ?>, <?php echo $overallShotfallKZN ?>]
        ]);

        var options = {
          chart: {
            title: 'Overall Project Perfomance : <?php echo $finalPercentage ?> %'
          }
        };

        var chart = new google.charts.Bar(document.getElementById('sp_overall_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="sp_overall_material" style="width: 1000px; height: 500px;"></div>
  </body>
</html>
