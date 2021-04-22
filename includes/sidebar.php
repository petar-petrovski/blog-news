<div class="col-md-4">



<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login -->
<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Enter username">
        </div>
    <div class="input-group">
        <input type="password" name="password" class="form-control" placeholder="Enter password">
        <span class="input-group-btn">
        <button class="btn btn-primary" name="login" type="submit">Login</button>
        </span>
    </div>
    
    
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">

<?php

        $sql = "SELECT * FROM categories"; //"SELECT * FROM categories LIMIT 1";
        //$select_all_categories_query = mysqli($connection, $query);

        $query = $db->prepare($sql);                        // pripremi go za pracanje kon baza, ne e uste prateno //
                                                            //prepare e predefinirana methoda koja proveruva dali e cista informacija za databaza
        $query->execute();                                  //go ispraca kon baza //vraca true ili false
        $sidebar_categories = $query->fetchAll(PDO::FETCH_ASSOC);

        // print_r($categories);
       
?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php 

                    foreach ($sidebar_categories as $category){
                    $cat_title = $category ['cat_title'];
                    $cat_id = $category ['id_cat'];
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
             }?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->

    <?php include "widget.php"; ?>


</div>