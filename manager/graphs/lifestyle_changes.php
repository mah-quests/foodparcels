
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawPractisingSocialDistance);

      google.charts.setOnLoadCallback(drawLifeStyleChange);

      function drawPractisingSocialDistance() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Front Line Workers');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Practising Social Distance Always', <?php echo $numOfYesPracticeSocialDistancing ?>],
          ['Dont Practising Social Distancing', <?php echo $numOfNoPracticeSocialDistancing ?>],
          ['Practising Social Distancing Most Times', <?php echo $numOfMostTimesPracticeSocialDistancing ?>],
          ['Practising Social Distancing Sometimes', <?php echo $numOfSometimesPracticeSocialDistancing ?>]
        ]);

        var options = {title:'Age Brackets',
                       width:500,
                       height:400,
                       pieHole: 0.4,
                     };

        var chart = new google.visualization.PieChart(document.getElementById('age_segmentation_barchart_div'));
        chart.draw(data, options);
      }

      function drawLifeStyleChange() {

      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
         ['How I spend time with my family', <?php echo $numOfFamilyLifeStyleChange ?>, '#d9aa20'],  
         ['How I attend places of worship', <?php echo $numOfWorshipLifeStyleChange ?>, '#fec001'], 
         ['How I socialise with friends', <?php echo $numOfFriendsLifeStyleChange ?>, '#d1af94'],
         ['How I conduct myself at work', <?php echo $numOfWorkLifeStyleChange ?>, '#e9e9e9'],
         ['Where I go for shopping', <?php echo $numOfShoppingLifeStyleChange ?>, 'color: #f2c769' ], 
         ['Places outside of my community that I will travel to', <?php echo $numOfTravelLifeStyleChange ?>, 'color: #717077' ], 
         ['Other', <?php echo $numOfOtherLifeStyleChange ?>, 'color: #b0b0b0' ], 
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
        height: 500,
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
