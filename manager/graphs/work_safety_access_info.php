<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Services', 'Speakers (in millions)'],

          ['Work Office', <?php echo $numOfWorkOfficeAccessInfomation ?>], 
          ['My Manager', <?php echo $numOfMyManagerAccessInfomation ?>], 
          ['E-mail', <?php echo $numOfEMailAccessInfomation ?>],

          ['Social Media', <?php echo $numOfSocialMediaAccessInfomation ?>], 
          ['Billboards', <?php echo $numOfBillboardsAccessInfomation ?>], 
          ['Some', <?php echo $numOfSomeAccessInfomation ?>],

          ['Internet Search', <?php echo $numOfInternetSearchAccessInfomation ?>], 
          ['Printed Media', <?php echo $numOfPrintedMediaAccessInfomation ?>], 
          ['SMS', <?php echo $numOfSMSAccessInfomation ?>],

          ['Radio & TV', <?php echo $numOfRadioTVAccessInfomation ?>], 
          ['Municipalities', <?php echo $numOfMunicipalitiesAccessInfomation ?>], 
          ['Neighbourhood', <?php echo $numOfNeighbourhoodCommitteeAccessInfomation ?>],

          ['NPOs', <?php echo $numOfLocalNPOCommitteeAccessInfomation ?>], 
          ['', 0], 
          ['', 0],
        ]);

        var options = {
          title: 'Where are you accessing information on workplace regulations',
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