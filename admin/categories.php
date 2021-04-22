<?php   include "includes/admin_header.php"; ?>

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
Manage Categories
            </h1>

<!-- Form -->
        <div class="col-xs-6">

<?php insert_category(); ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="cat_title">Category Title</label>
                <input class="form-control" type="text" name = "cat_title">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name = "submit" value="Add category">
            </div>
        </form>
               

<?php 
    if(isset($_GET['edit'])){    
    include "includes/edit_category.php"; 
    }
?>
            </div>

            <div class="col-xs-6">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Title</th>
                        <th>Delete Category</th>
                    </tr>
                </thead>
                <tbody>

<?php findAllCategories() ?>
<?php deleteCategory(); ?>

                </tbody>
            </table>
            </div>
        </div> <!-- /.col-lg-12 -->

    </div>
                <!-- /.row -->

    </div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>
