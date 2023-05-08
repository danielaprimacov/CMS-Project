<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $query = "SELECT * FROM posts";
                        $selectAllPosts = mysqli_query($connection, $query);
                        if (!$selectAllPosts) {
                            die("Query failed!" . mysqli_error($connection));
                        }
                        $postCount = mysqli_num_rows($selectAllPosts);
                        ?>
                        <div class='huge'><?php echo $postCount; ?></div>
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
                        <?php
                        $query = "SELECT * FROM comments";
                        $selectAllComments = mysqli_query($connection, $query);
                        if (!$selectAllComments) {
                            die("Query failed!" . mysqli_error($connection));
                        }
                        $commentCount = mysqli_num_rows($selectAllComments);
                        ?>
                        <div class='huge'><?php echo $commentCount; ?></div>
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
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $query = "SELECT * FROM users";
                        $selectAllUsers = mysqli_query($connection, $query);
                        if (!$selectAllUsers) {
                            die("Query failed!" . mysqli_error($connection));
                        }
                        $userCount = mysqli_num_rows($selectAllUsers);
                        ?>
                        <div class='huge'><?php echo $userCount; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
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
                        <?php
                        $query = "SELECT * FROM categories";
                        $selectAllCategories = mysqli_query($connection, $query);
                        if (!$selectAllCategories) {
                            die("Query failed!" . mysqli_error($connection));
                        }
                        $cateogryCount = mysqli_num_rows($selectAllCategories);
                        ?>
                        <div class='huge'><?php echo $cateogryCount; ?></div>
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
$query = "SELECT * FROM posts WHERE post_status = 'Published'";
$selectAllPubPosts = mysqli_query($connection, $query);
$publishedCount = mysqli_num_rows($selectAllPubPosts);
if(!$selectAllPubPosts){
    die("Query failed!" . mysqli_error($connection));
}


$query = "SELECT * FROM posts WHERE post_status = 'Draft'";
$selectAllDraftPosts = mysqli_query($connection, $query);
$draftCount = mysqli_num_rows($selectAllDraftPosts);
if(!$selectAllDraftPosts){
    die("Query failed!" . mysqli_error($connection));
}

$query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
$selectAllUnapCom = mysqli_query($connection, $query);
$unapComCount = mysqli_num_rows($selectAllUnapCom);
if(!$selectAllUnapCom){
    die("Query failed!" . mysqli_error($connection));
}

$query = "SELECT * FROM users WHERE user_role = 'User'";
$selectAllUser = mysqli_query($connection, $query);
$userScount = mysqli_num_rows($selectAllUser);
if(!$selectAllUser){
    die("Query failed!" . mysqli_error($connection));
}
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
                $elements = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Simple Users', 'Categories'];
                $countElements = [$postCount, $publishedCount, $draftCount, $commentCount, $unapComCount, $userCount, $userScount, $cateogryCount];

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