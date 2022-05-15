
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(darawvaccineInfoSafeChart);

      google.charts.setOnLoadCallback(drawVaccineSafe);

      function darawvaccineInfoSafeChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Earn a living');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Strongly Agree', <?php echo $numOfInformedEnoughSAgree ?>],
          ['Agree', <?php echo $numOfInformedEnoughAgree ?>],
          ['Neither Agree nor Disagree', <?php echo $numOfInformedEnoughNutral ?>],
          ['Disagree', <?php echo $numOfInformedEnoughDisagree ?>],
          ['Strongly disagree', <?php echo $numOfInformedEnoughSDisagree ?>]
        ]);

        var options = {title:'Are you informed enough to take COVID-19 Vaccine',
                       width:600,
                       height:400,
                       pieHole: 0.4,
                     };

        var chart = new google.visualization.PieChart(document.getElementById('vaccine_info'));
        chart.draw(data, options);
      }

      function drawVaccineSafe() {

      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
         [' Strongly agree', <?php echo $numOfVaccineSafeSAgree ?>, '#676767'],  
         [' Agree', <?php echo $numOfVaccineSafeAgree ?>, '#fec001'], 
         [' Neither Agree nor Disagree', <?php echo $numOfVaccineSafeNutral ?>, '#d1af94'],
         [' Disagree', <?php echo $numOfVaccineSafeDisagree ?>, '#fec024'], 
         [' Strongly disagree', <?php echo $numOfVaccineSafeSDisagree ?>, '#d1af94'],
      ]);       


      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Is the vaccine safe?",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("vaccine_safe"));
      chart.draw(view, options);
  }

    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td>
            <div id="vaccine_safe" style="border: 0px solid #ccc">
            </div>
        </td>
        <td>
            <div id="vaccine_info" style="border: 0px solid #ccc">
            </div>
        </td>                
      </tr>
      
    </table>
  </body>
</html>
