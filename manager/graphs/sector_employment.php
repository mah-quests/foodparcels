<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawHabbitsTooDifficult);
        function drawHabbitsTooDifficult() {
          var data = google.visualization.arrayToDataTable([
            ["Difficult Behaviours ", "Numbers", { role: "style" } ],
            ["Students",<?php echo 6745 ?>,"#943b6a"],
            ["Employed, working 1-20 hours per week", <?php echo 6754 ?>, "#63008d"],
            ["Employed, working 21 – 40+ or more hours per week", <?php echo 564 ?>, "#5600ce"],
            ["Not employed, looking for work", <?php echo 5643 ?>, "#717077"],
            ["Not employed, NOT looking for work", <?php echo 757 ?>, "#816e60"],
            ["Disabled, not able to work", <?php echo 1045 ?>, "#c5ae60"],            
            ["Retired / Pensioner", <?php echo 1985 ?>, "#1a2135"]
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
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.BarChart(document.getElementById("habits_to_break_barchart"));
          chart.draw(view, options);
      }
      </script>
    <div id="habits_to_break_barchart" style="width: 1100px; height: 400px;"></div>
  </head>
  <body>
  </body>
</html>
