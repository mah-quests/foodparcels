
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawWashHands);

      google.charts.setOnLoadCallback(drawSanitiserUse);

      function drawWashHands() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Front Line Workers');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Washing Hands Throughout The Day', <?php echo $numOfWashHandsThroughDay ?>],
          ['Washing Hands Daily', <?php echo $numOfWashHandsDaily ?>],
          ['Washing Hands Few times A Week', <?php echo $numOfWashHandsFewTimesWeek ?>],
          ['Washing Hands Weekly', <?php echo $numOfWashHandsWeekly ?>],
          ['Washing hands 3 Times in A Month ', <?php echo $numOfWashHands3TimesMonth ?>],
          ['Never Wash Hands', <?php echo $numOfWashHandsNever ?>]
        ]);

        var options = {title:'Washing Hands',
                       width:500,
                       height:400,
                       pieHole: 0.4,
                     };

        var chart = new google.visualization.PieChart(document.getElementById('sanitiser_barchart'));
        chart.draw(data, options);
      }

      function drawSanitiserUse() {

      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
         ['Use Sanitiser Throughout The Day', <?php echo $numOfUseSanitisersThroughDay ?>, '#d9aa20'],  
         ['Use Sanitiser Daily', <?php echo $numOfUseSanitisersDaily ?>, '#fec001'], 
         ['Use Sanitiser Few Times A Week', <?php echo $numOfUseSanitisersFewTimesWeek ?>, '#d1af94'],
         ['Use Sanitiser Weekly', <?php echo $numOfUseSanitisersWeekly ?>, '#e9e9e9'],
         ['Use Sanitiser 3 Time A Month', <?php echo $numOfUseSanitisers3TimesMonth ?>, 'color: #f2c769' ], 
         ['Never use Sanitiser', <?php echo $numOfUseSanitisersNever ?>, 'color: #717077' ], 

      ]);       


      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Use Of Alcohol-Based Sanitisers",
        width: 600,
        height: 500,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("washing_hands_barchart"));
      chart.draw(view, options);
  }

    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td>
            <div id="washing_hands_barchart" style="border: 0px solid #ccc">
            </div>
        </td>
        <td>
            <div id="sanitiser_barchart" style="border: 0px solid #ccc">
            </div>
        </td>                
      </tr>
      
    </table>
  </body>
</html>
