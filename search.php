<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

  <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            


            <?php

include 'includes/db.php';

if(isset($_POST['submit'])){

    $search = trim($_POST['search']);
    
    
    if (!empty($search)){       //checks if the search field was sent empty or with some value, if its not empty code continues to QUERY
        
         // $sql = "SELECT * FROM posts";

    $sql = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";

    $query = $db->prepare($sql);
    $query->execute();
    $search_query = $query->fetchAll(PDO::FETCH_ASSOC);

    if(!array_filter ($search_query)){      //if $search has some value this line check to see if database will return some value //apply_filter checks for empty array
        echo "<h1>NO RESULT</h1>";
        } else {                            //if the array will match some results print this:
            
            foreach ($search_query as $post){
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
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
            <?php } 
                } 
            } else {

        echo "<h1>EMPTY SEARCH</h1>";

    }
}

// $result = mysqli_result($search_query);
// if(!$search_query){
//     die("query failed" . mysqli_error($db));
// } 

// $count = $query->rowCount(); //this line count all rows in the database
// $count = $query->rowCount();
// $count = $query->fetchColumn(); //this line counts results

// if($count == 0) {

//     echo "NO RESULT";
// } else {
//         echo 'some result';
//     }

?>
                

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>