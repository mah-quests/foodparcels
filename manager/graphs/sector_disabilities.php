<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawDisabilityAge);

      google.charts.setOnLoadCallback(drawDisabilityType);

      function drawDisabilityAge() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Disability Ages');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Yes', <?php echo $numOfDisabled; ?>],
          ['No', <?php echo ($numOfCompletedSurveys - $numberOfChildrenWithDisabilities); ?>]
        ]);

        var options = {title:'Total number of people with disabilities: <?php echo $numOfDisabled; ?>',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('DisabilityAge_chart_div'));
        chart.draw(data, options);
      }

      function drawDisabilityType() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Disability Type');
        data.addColumn('number', 'Numbers');
        data.addRows([
          ['Physical Disability', <?php echo $numOfDisabledPhysical; ?>],
          ['Vision Impairment', <?php echo $numOfDisabledImpairment; ?>],
          ['Deaf or hard of hearing', <?php echo $numOfDisabledDeaf; ?>],
          ['Intellectual disability', <?php echo $numOfDisabledIntellectual; ?>],
          ['Acquired brain injury', <?php echo $numOfDisabledBrainInjury; ?>]
        ]);

        var options = {title:'Types of Disabilities',
                       width:600,
                       height:400};

        var chart = new google.visualization.PieChart(document.getElementById('DisabilityType_chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td>
          <div id="DisabilityAge_chart_div" style="border: 0px solid #ccc">
          </div>
        </td>
        <td>
          <div id="DisabilityType_chart_div" style="border: 0px solid #ccc">
          </div>
        </td>
      </tr>
    </table>
  </body>
</html>
