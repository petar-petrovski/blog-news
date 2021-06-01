<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

  <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>


<?php 

$sql = "SELECT * FROM posts WHERE post_status = 'published'";

$query = $db->prepare($sql);
$query->execute();
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

// print_r($categories);
foreach ($posts as $post){
    $post_id = $post ['post_id'];
    $post_title = $post ['post_title'];
    $post_author = $post ['post_author'];
    $post_date = $post ['post_date'];
    $post_image = $post ['post_image'];
    $post_content = substr($post ['post_content'],0,50);

    ?>
    

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?= $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?= $post_id ?>">
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
<?php } ?>

                

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>