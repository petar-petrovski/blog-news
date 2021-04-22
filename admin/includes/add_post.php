<?php

if(isset($_POST['create_post'])){

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_cat_id = $_POST['post_category_id'];  
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date("d-m-y");
    $post_comments_count = 0;
    
    move_uploaded_file($post_image_temp,"../images/$post_image");

    $sql = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)
            VALUES ('{$post_cat_id}','{$post_title}','{$post_author}', now() ,'{$post_image}','{$post_content}','{$post_tags}','{$post_comments_count}','{$post_status}')";
    
    $query = $db->prepare($sql);
    $query->execute();

    header("Location: posts.php");
}
?>

<div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title">
</div>

<div class="form-group">
<label for="post_category">Post Category ID</label><br>
<select class="form-control" name="post_category_id" id="">
    <?php
    $sql = "SELECT * FROM categories"; 
    $query = $db->prepare($sql);
    $query->execute();

    confirmQuery($query);


    while ($categories = $query->fetch(PDO::FETCH_ASSOC)){
            $category_id = $categories['id_cat'];
            $category_title = $categories['cat_title'];
            echo "<option name='' value='{$category_id}'>{$category_title}</option>";
        }
    ?>
</select>
</div>

<div class="form-group">
<label for="post_author">Author</label>
<input type="text" class="form-control" name="author">
</div>

<div class="form-group">
<label for="post_status">Post Status</label>
<select name="post_status" class="form-control" id="">
<option value="published">Published</option>
<option value="not published">Not Published</option>
<option value="draft">Draft</option>
</select>
<!-- <input type="text" class="form-control" name="post_status"> -->
</div>

<div class="form-group">
<label for="post_image">Post image</label>
<input type="file" class="form-control" name="image">
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea class="form-control" name="post_content" id="" cols="30" rows="10">
</textarea>
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_post" value="Publish post">
</div>

</form></div>