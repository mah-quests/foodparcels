
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Stock", "Qty", { role: "style" } ],
        ["Maize \n Meal", <?php echo $row->total_maize_meal ?>, "#FFDAE1"],
        ["Rice", <?php echo $row->total_rice ?>, "#D6EBFF"],
        ["Sugar", <?php echo $row->total_sugar ?>, "#FFF3DA"],
        ["Cooking \n Oil", <?php echo $row->total_cooking_oil ?>, "#DBF5F5"],
        ["Tea", <?php echo $row->total_tea ?>, "#E6D9FF"],
        ["Baked \n Beans", <?php echo $row->total_baked_beans ?>, "#FFE9D7"],
        ["All \n Purpose \n Soap", <?php echo $row->total_all_purpose_soap ?>, "#DBF5F5"],
        ["Soya \n Mince", <?php echo $row->total_soya_mince ?>, "#FFDAE1"],
        ["Cabbage", <?php echo $row->total_cabbage ?>, "#FFF3DA"],
        ["Potatoes", <?php echo $row->total_potatoes ?>, "#DBF5F5"],
        ["Pumpkin", <?php echo $row->total_pumpkin ?>, "#E6D9FF"]
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
        width: 1000,
        height: 500,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("stock_amounts"));
      chart.draw(view, options);
  }
  </script>
<div id="stock_amounts" style="width: 1000px; height: 500px;"></div>