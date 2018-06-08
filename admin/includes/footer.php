  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- tinymce text editor WYSISWYG -->
    
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <script src="js/scripts.js" type="text/javascript"></script>
	<!-- google api from header -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['views',    <?php echo $session->count;?>],
          ['Comment',      <?php echo Comment::count_all();?>],
          ['Users',   <?php echo Users::count_all();?>],
          ['Photos', <?php echo Photo::count_all();?>],
        ]);

        var options = {
          pieSliceText:'label',
          backgroundColor:'transparent',
          is3D: true,	
          title: 'DASHBOARD ANALITICS'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
