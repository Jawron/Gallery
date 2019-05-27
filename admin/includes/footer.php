  </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

          var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Views',     <?php echo $session->count;?>],
              ['Photos',      <?php echo Photo::countAll();?>],
              ['Users',  <?php echo User::countAll();?>],
              ['Comments', <?php echo Comment::countAll();?>]
          ]);

          var options = {

              pieSliceText: 'label',
              title: 'My Daily Activities',
              slices: {
                  0: {
                      color: '#d24d57'
                  },
                  1: {
                      color: '#9f5afd'
                  },
                  2:{
                      color: '#2c3e50'
                  },
                  3:{
                      color: '#1e824c'
                  }
              }

          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
      }
  </script>
</body>

</html>
