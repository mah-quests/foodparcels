
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Christian", <?php echo 4543 ?>, "#b87333"],
        ["Islam", <?php echo 3453 ?>, "silver"],
        ["Hinduism", <?php echo 2453 ?>, "gold"],
        ["African Religion", <?php echo 4537 ?>, "#b87333"],
        ["Judaism", <?php echo 564 ?>, "silver"],
        ["Atheist", <?php echo 245 ?>, "gold"],
        ["Rastafarian", <?php echo 1452 ?>, "#b87333"],
        ["Prefer not to say", <?php echo 865 ?>, "silver"],
        ["Other Religion", <?php echo 46 ?>, "gold"]
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