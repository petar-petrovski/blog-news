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

if(isset($_GET['p_id'])){
    $post_id = $_GET['p_id'];
}

$sql = "SELECT * FROM posts WHERE post_id = $post_id";

$query = $db->prepare($sql);
$query->execute();
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

// print_r($categories);
foreach ($posts as $post){
    $post_title = $post ['post_title'];
    $post_author = $post ['post_author'];
    $post_date = $post ['post_date'];
    $post_image = $post ['post_image'];
    $post_content = $post ['post_content'];

    ?>
    

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <!-- TODO: Hide the read more button on post page -->
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->
                <hr>



                <!-- Blog Comments -->

                <?php
                if(isset($_POST['create_comment'])){
                    $post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    //TODO: checkup if post exists, for example if you open page and manually add id, there is no post but you can add comment
                    //the data and comment are inserted but link to the post doesnt exists
                    
                    $sql = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)
                    VALUES ('{$post_id}','{$comment_author}','{$comment_email}', '{$comment_content}' ,'unapproved', now())";
            
                    $query = $db->prepare($sql);
                    $query->execute();

                    $sql = "UPDATE posts
                            SET post_comment_count = post_comment_count + 1
                            WHERE post_id = '{$post_id}'";
                            
                     $query = $db->prepare($sql);
                     $query->execute();

                }
                
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                        <label for="author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="Email">Email</label>

                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                        <label for="comment">Your Comment:</label>

                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>                
                <hr>

                <!-- Posted Comments -->

                <?php 
                $sql = "SELECT * FROM comments
                        WHERE comment_post_id = {$post_id}
                        AND comment_status = 'approved'
                        ORDER BY comment_id DESC";
        
                $query = $db->prepare($sql);
                $query->execute();

                while ($comments = $query->fetch(PDO::FETCH_ASSOC)){
                    $list_comment_date = $comments['comment_date'];
                    $list_comment_content = $comments['comment_content'];
                    $list_comment_author = $comments['comment_author'];                 

                ?>

                <!-- Comment -->

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $list_comment_author ?>
                            <small><?= $list_comment_date ?></small>
                        </h4>
                        <?= $list_comment_content ?>
                    </div>
                </div>
                <!-- closes -> comments WHILE -->
                <?php } ?>
        

                <!-- closes -> if(isset($_GET['p_id'])) -->
                <?php } ?>               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>