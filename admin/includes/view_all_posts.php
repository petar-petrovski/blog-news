<?php 
if(isset($_POST['checkBoxArray'])){

    foreach ($_POST['checkBoxArray'] as $checkBoxValue){
        echo $checkBoxValue;
    }
}

?>
<form action="" method="post">

<div id="bulkOptionsContainer" class="col-xs-4">
<select class="form-control" name="" id="">
<option value="">Select Options</option>
<option value="">Published</option>
<option value="">Draft</option>
<option value="">Delete
</option>
</select></div>
<button style="position:relative; float:right;" class="btn btn-primary"><a href="posts.php?source=add_post" style="color:white; text-decoration: none;">Add new post</a></button></form><br><br>

<table class="table table-bordered table-hover">



                <thead>
                    <tr>
                        <th><input id="selectAll" type="checkbox"></th>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>                        
                        <th>Comments</th>
                        <th>Date</th>
                        <th colspan="2" style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>

<?php 

$sql = "SELECT * FROM posts"; 
    $query = $db->prepare($sql);
    $query->execute();
    $all_posts = $query->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($all_posts);
    // echo '</pre>';
    // die();
    foreach ($all_posts as $post){


        $post_id = $post['post_id'];
        $author = $post['post_author'];
        $post_title = $post['post_title'];
        $post_cat = $post['post_category_id'];
        $post_status = $post['post_status'];
        $post_image = $post['post_image'];
        $post_tags = $post['post_tags'];
        $post_comments = $post['post_comment_count'];
        $post_date = $post['post_date'];


        echo "<tr>";
        echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$author}</td>";
        echo "<td>{$post_title}</td>";

        $sql = "SELECT * FROM categories WHERE id_cat = $post_cat"; 
        $query = $db->prepare($sql);
        $query->execute();
    
        while ($category_values = $query->fetch(PDO::FETCH_ASSOC)){
                $cat_id = $category_values['id_cat'];
                $cat_title = $category_values['cat_title'];
            

                echo "<td>{$cat_title}</td>";
            }



        echo "<td>{$post_status}</td>";
        echo "<td><img src='../images/{$post_image}' alt='image' width='auto' height='70'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comments}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td></tr>";
        
        
    }

?>
                </tbody>
            </table>
            </form>

<?php

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];

        $sql = "DELETE FROM posts WHERE post_id = {$delete_id}";

        $query = $db->prepare($sql);
        $query->execute();

        //TODO: if the post is deleted, delete all related comments
        //TODO: are you sure confirmation before execution

            $sql = "DELETE FROM comments WHERE comment_post_id = {$delete_id}";
            $query = $db->prepare($sql);
            $query->execute();

        header("Location: posts.php");
    }

?>