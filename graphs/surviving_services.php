<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Services', 'Speakers (in millions)'],

          ['Have Access to Counselling', <?php echo $numOfAccessToCounselling ?>], 
          ['Have Access to Physical Rehab', <?php echo $numOfPhysicalRehab ?>], 
          ['Have Access to Disability Grant', <?php echo $numOfDisabilityGrant ?>],

          ['Have Access to Access Medication', <?php echo $numOfAccessMedication ?>], 
          ['Have Access to Information', <?php echo $numOfInformation ?>], 
          ['Have Access to No Access', <?php echo $numOfNoAccess ?>],

          ['Do Not Access to Services?>', <?php echo $numOfNoAccess ?>], 
          ['', 0], 
          ['', 0],

          ['Need Access to Counselling', <?php echo $numOfNeedAccessToCounselling ?>], 
          ['Need Access to Physical Rehab', <?php echo $numOfNeedPhysicalRehab ?>], 
          ['Need Access to Disability Grant', <?php echo $numOfNeedDisabilityGrant ?>],


          ['Need Access to Access Medication', <?php echo $numOfNeedAccessMedication ?>], 
          ['Need Access to Information', <?php echo $numOfNeedInformation ?>], 
          ['Need Access to No Access', <?php echo $numOfNeedNoAccess ?>],

          ['Do Not Need Access to Services?>', <?php echo $numOfNeedOtherAccess ?>], 
          ['', 0], 
          ['', 0],
        ]);

        var options = {
          title: 'Access To Services & Services Needed',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1200px; height: 500px;"></div>
  </body>
</html>