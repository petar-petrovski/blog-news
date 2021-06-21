<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php

                    $sql = "SELECT * FROM categories";
                    //$select_all_categories_query = mysqli($connection, $query);

                    $query = $db->prepare($sql);                        // pripremi go za pracanje kon baza, ne e uste prateno //
                                                                        //prepare e predefinirana methoda koja proveruva dali e cista informacija za databaza
                    $query->execute();                                  //go ispraca kon baza //vraca true ili false
                    $categories = $query->fetchAll(PDO::FETCH_ASSOC);


                    // print_r($categories);
                    foreach ($categories as $category){
                        $cat_title = $category ['cat_title'];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    
                    }
?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
<?php

if(isset($_SESSION['role'])){

    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];
        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
    }
}


?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>