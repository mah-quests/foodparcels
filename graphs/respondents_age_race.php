
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawAgeSegmentsChart);

      google.charts.setOnLoadCallback(drawRageSegmentation);

      function drawAgeSegmentsChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Front Line Workers');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Between 18 to 24 years', <?php echo 4350 ?>],
          ['Between 25 to 34 years', <?php echo 6724 ?>],
          ['Between 35 to 44 years', <?php echo 4564 ?>],
          ['Between 45 to 54 years', <?php echo 4233 ?>],
          ['Between 55 to 64 years', <?php echo 5642 ?>],          
          ['Over 65 years', <?php echo 4546 ?>]
        ]);

        var options = {title:'Age Brackets',
                       width:550,
                       height:400,
                       pieHole: 0.4,
                     };

        var chart = new google.visualization.PieChart(document.getElementById('age_segmentation_barchart_div'));
        chart.draw(data, options);
      }

      function drawRageSegmentation() {

      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
         ['African (Black)', <?php echo 1989 ?>, '#676767'],  
         ['Colored', <?php echo 342 ?>, '#fec001'], 
         ['Indian', <?php echo 675 ?>, '#d1af94'],
         ['White', <?php echo 565 ?>, '#e9e9e9'],
         ['Other', <?php echo 53 ?>, 'color: #425d2c' ], 
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
        width: 550,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("race_barchart_div"));
      chart.draw(view, options);
  }

    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td>
            <div id="race_barchart_div" style="border: 0px solid #ccc">
            </div>
        </td>
        <td>
            <div id="age_segmentation_barchart_div" style="border: 0px solid #ccc">
            </div>
        </td>                
      </tr>
      
    </table>
  </body>
</html>
