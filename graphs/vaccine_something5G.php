
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

  //oogle.charts.setOnLoadCallback(drawSafeWorkEnvironment);
      google.charts.setOnLoadCallback(drawSomething5G);

      function drawSafeWorkEnvironment() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Working environment');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Working environment safe against COVID: Yes', <?php echo $numOfYesSafeWorkplace; ?>],
          ['Working environment safe against COVID: No', <?php echo $numOfNoSafeWorkplace; ?>],
          ['Working environment safe against COVID: Somewhat', <?php echo $numOfSomewhatSafeWorkplace; ?>]
        ]);

        var options = {title:'Has your employer taken any steps to make your working environment safe against COVID infection',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('safe_work_env_chart_div'));
        chart.draw(data, options);
      }

      function drawSomething5G() {
        var data = google.visualization.arrayToDataTable([
          ['Measurements taken by the employer', '#'],
          ['Strongly Agree', <?php echo $numOfSomething5GSAgree ?> ],
          ['Agree', <?php echo $numOfSomething5GAgree ?> ],
          ['Neither Agree nor Disagree', <?php echo $numOfSomething5GNutral ?> ],
          ['Disagree', <?php echo $numOfSomething5GDisagree ?> ],
          ['Strongly Disagree', <?php echo $numOfSomething5GSDisagree ?> ]
        ]);

        var options = {
          title: 'COVID19 has something to do with 5G',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('something5G'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
   
       
        <div id="something5G" style="width: 1200px; height: 500px;"></div>
     
  </body>
</html>
