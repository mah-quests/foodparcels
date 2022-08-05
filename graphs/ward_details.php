
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawAgeSegmentsChart);

      google.charts.setOnLoadCallback(drawRageSegmentation);

      function drawAgeSegmentsChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Ward Code Colors');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Red', <?php echo 4350 ?>],
          ['Yellow', <?php echo 6724 ?>],
          ['Green', <?php echo 4546 ?>]
        ]);

        var options = {title:'Ward Color Details',
                       width:450,
                       height:400,
                       pieHole: 0.5,
                       colors: ['#770A04', '#E2A501', '#164735']
                     };

        var chart = new google.visualization.PieChart(document.getElementById('age_segmentation_barchart_div'));
        chart.draw(data, options);
      }

      function drawRageSegmentation() {

      var data = google.visualization.arrayToDataTable([
        ["Element", "Grant", { role: "style" } ],
         ['CSG', <?php echo 1989 ?>, '#676767'],  
         ['OLD AGE', <?php echo 1342 ?>, '#fec001'], 
         ['DISABILITY', <?php echo 1675 ?>, '#d1af94'],
         ['FOSTER CARE', <?php echo 1565 ?>, '#e9e9e9'],
         ['NONE', <?php echo 342 ?>, '#aece01'], 
         ['OTHER', <?php echo 553 ?>, 'color: #425d2c' ], 
      ]);       


      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Grant Details",
        width: 500,
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
