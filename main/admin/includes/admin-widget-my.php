<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-file-text fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class='huge'><?php echo $postCount =  count_records(getAllUserPosts()); ?></div>
            <div>Posts</div>
          </div>
        </div>
      </div>
      <a href="./posts.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-comments fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class='huge'><?php echo $commentCount = count_records(getAllUserComments()); ?></div>
            <div>Comments</div>
          </div>
        </div>
      </div>
      <a href="./comments.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-list fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class='huge'><?php echo $cateogryCount = count_records(getAllUserCategories()); ?></div>
            <div>Categories</div>
          </div>
        </div>
      </div>
      <a href="./categories.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
</div>
<!-- /.row -->

<?php
$publishedPosts = count_records(getAllUserPublishedPosts());

$draftCount = count_records(getAllUserDraftPosts());

$unapComCount = count_records(getAllUserUnapprovedComments());

?>


<div class="row">
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Count'],

        <?php
        $elements = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Categories'];
        $countElements = [$postCount, $publishedCount, $draftCount, $commentCount, $unapComCount, $categoryCount];

        for ($i = 0; $i < sizeof($elements); $i++) {
          echo "['{$elements[$i]}'" . "," . "{$countElements[$i]}],";
        }
        ?>
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>