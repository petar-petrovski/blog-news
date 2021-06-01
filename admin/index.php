<?php include "includes/admin_header.php"; ?>

<body>

    <div id="wrapper">



        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin page

                            
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
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
                     $sql = "SELECT * FROM posts";
                     $query = $db->prepare($sql);
                     $query->execute();
                     $all_posts = $query->fetchAll(PDO::FETCH_ASSOC);
                     $post_count = count($all_posts);

                     echo "<div class='huge'>$post_count</div>"
                    ?>
                 
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
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
                     $sql = "SELECT * FROM comments";
                     $query = $db->prepare($sql);
                     $query->execute();
                     $all_comments = $query->fetchAll(PDO::FETCH_ASSOC);
                     $comment_count = count($all_comments);

                     echo "<div class='huge'>$comment_count</div>"
                    ?>

                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
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
                     $sql = "SELECT * FROM users";
                     $query = $db->prepare($sql);
                     $query->execute();
                     $all_users = $query->fetchAll(PDO::FETCH_ASSOC);
                     $user_count = count($all_users);

                     echo "<div class='huge'>$user_count</div>"
                    ?>
                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
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
                     $sql = "SELECT * FROM categories";
                     $query = $db->prepare($sql);
                     $query->execute();
                     $all_categories = $query->fetchAll(PDO::FETCH_ASSOC);
                     $category_count = count($all_categories);

                     echo "<div class='huge'>$category_count</div>"
                    ?>
                        
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
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
 
                $sql = "SELECT * FROM posts where post_status = 'draft'";
                $query = $db->prepare($sql);
                $query->execute();
                $all_draft_posts = $query->fetchAll(PDO::FETCH_ASSOC);
                $post_draft_count = count($all_draft_posts);

                $sql = "SELECT * FROM posts where post_status = 'published'";
                $query = $db->prepare($sql);
                $query->execute();
                $all_published_posts = $query->fetchAll(PDO::FETCH_ASSOC);
                $post_published_count = count($all_published_posts);



            ?>

            <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Date', 'Count'],

                    <?php 
                    $element_text = ['All Posts', 'Draft posts','Published posts', 'Comments', 'Users', 'Categories'];
                    $element_count = [$post_count, $post_draft_count, $post_published_count, $comment_count, $user_count, $category_count];

                    for($i=0; $i < 6; $i++){
                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

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
            <div id="columnchart_material" style="width: 'auto'; height: 600px;"></div>
                
                
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>
