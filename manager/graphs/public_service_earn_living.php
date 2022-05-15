
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawEarnLivingChart);

      google.charts.setOnLoadCallback(drawChangedEmployment);

      function drawEarnLivingChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Earn a living');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Self employed', <?php echo $numOfSelfEmployed ?>],
          ['Unemployed', <?php echo $numOfUnemployed ?>],
          ['Employed (part time)', <?php echo $numOfEmployedPartTime ?>],
          ['Employed (permanent)', <?php echo $numOfEmployedPermanent ?>],
          ['Informal trader', <?php echo $numOfInformalTrader ?>]
        ]);

        var options = {title:'How do you earn a living',
                       width:600,
                       height:400,
                       pieHole: 0.4,
                     };

        var chart = new google.visualization.PieChart(document.getElementById('earn_living_barchart_div'));
        chart.draw(data, options);
      }

      function drawChangedEmployment() {

      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
         ['Changed Employment: Yes', <?php echo $numOfYesChangedEmployment ?>, '#676767'],  
         ['Changed Employment: No', <?php echo $numOfNoChangedEmployment ?>, '#fec001'], 
         ['Changed Employment: Unsure', <?php echo $numOfUnsureChangedEmployment ?>, '#d1af94'],
      ]);       


      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Race Segmentations",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("changed_employment_barchart_div"));
      chart.draw(view, options);
  }

    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td>
            <div id="changed_employment_barchart_div" style="border: 0px solid #ccc">
            </div>
        </td>
        <td>
            <div id="earn_living_barchart_div" style="border: 0px solid #ccc">
            </div>
        </td>                
      </tr>
      
    </table>
  </body>
</html>
