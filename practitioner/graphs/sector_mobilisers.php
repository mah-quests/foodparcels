
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Men", <?php echo $menSurveys ?>, "#feeb95"],
        ["Faith", <?php echo $faithSurveys ?>, "#ed7d31"],
        ["Women", <?php echo $womenSurveys ?>, "#f5f610"],
        ["Youth", <?php echo $youthSurveys ?>, "#fec001"],
        ["LGBTIQ", <?php echo $lgbtiSurveys ?>, "#cdcdca"],
        ["Labour", <?php echo $labourSurveys ?>, "#e5a612"],
        ["Research", <?php echo $researchSurveys ?>, "#ed7d31"],
        ["Children", <?php echo $childrenSurveys ?>, "#b0b0b0"],
        ["Sex Workers", <?php echo $sexWorkerSurveys ?>, "#a5a101"],
        ["Higher Education", <?php echo $higerEducationSurveys ?>, "#d1af94"],
        ["Law & Human Rights", <?php echo $humanRightsSurveys ?>, "#ffd42c"],
        ["Traditional Leaders", <?php echo $traditionalLeadersSurveys ?>, "#425d2c"],
        ["Health Professionals", <?php echo $healthProfessionalsSurveys ?>, "#d9aa20"],
        ["Sport, Arts & culture", <?php echo $sacSurveys ?>, "#676767"],
        ["People with Disabilities", <?php echo $peopleWithDisabilitiesSurveys ?>, "#fec001"],
        ["NPO", <?php echo $npoSurveys ?>, "#e8ae81"],
        ["Traditional Health", <?php echo $traditionalhealthSurveys ?>, "#9f9db2"], 
        ["PLHIV", <?php echo $lgbtiSurveys ?>, "#dbc2b1"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Sector Mobilizer Stats",
        width: 1100,
        height: 500,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("sector_mobilisers"));
      chart.draw(view, options);
  }
  </script>
<div id="sector_mobilisers"></div>