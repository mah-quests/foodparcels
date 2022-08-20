
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Total", "Density", { role: "style" } ],
        ["No. SA ID", <?php echo 14543 ?>, "#b87333"],
        ["No. SA Passport", <?php echo 3453 ?>, "silver"],
        ["No. Birth Certs", <?php echo 32453 ?>, "gold"],
        ["No. Other Country ID", <?php echo 2537 ?>, "#b87333"],
        ["No. Other Passport", <?php echo 9537 ?>, "#b87333"],
        ["No. NO Identification", <?php echo 3446 ?>, "gold"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: 1100,
        height: 550,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("mobilisers_surveys"));
      chart.draw(view, options);
  }
  </script>
<div id="mobilisers_surveys" style="width: 1200px; height: 550px;"></div>