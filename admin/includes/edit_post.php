<?php 

if(isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];


    $sql = "SELECT * FROM posts WHERE post_id = {$p_id}"; 
    $query = $db->prepare($sql);
    $query->execute();
    $edit_post = $query->fetch(PDO::FETCH_ASSOC);

    // print_r($edit_post);
    $post_title = $edit_post ['post_title'];
    $post_category_id = $edit_post ['post_category_id'];
    $post_author = $edit_post ['post_author'];
    $post_status = $edit_post ['post_status'];
    $post_image = $edit_post ['post_image'];
    $post_tags = $edit_post ['post_tags'];
    $post_content = $edit_post ['post_content'];

}

if (isset($_POST['update_post']) && isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];

    $new_title = $_POST['title'];
    $new_category = $_POST['post_category'];
    $new_author = $_POST['author'];
    $new_status = $_POST['post_status'];
    $new_tags = $_POST['post_tags'];
    $new_content = $_POST['post_content'];
    $new_date = date("d-m-y");

    $new_image = $_FILES['image']['name'];
    $new_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($new_image_temp,"../images/$new_image");

    if(empty($new_image)){
        $sql = "SELECT * FROM posts WHERE post_id = $p_id";
        $query = $db->prepare($sql);
        $query->execute();
        while ($post_data = $query->fetch(PDO::FETCH_ASSOC)){

        $new_image = $post_data['post_image'];

        }
    }

    $sql = "UPDATE posts 
            SET post_category_id = '{$new_category}', 
                post_title = '{$new_title}', 
                post_author = '{$new_author}', 
                post_content = '{$new_content}',
                post_image = '../images/{$new_image}',
                post_date = '{$new_date}', 
                post_tags = '{$new_tags}', 
                post_status = '{$new_status}'
            WHERE post_id = {$p_id}"; 

    $query = $db->prepare($sql);
    $query->execute();

    header("Location: posts.php");
    
}

?>

<div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title" value="<?= $post_title ?>">
</div>

<div class="form-group">
<select name="post_category" id="post_category">
<?php

$sql = "SELECT * FROM categories"; 
$query = $db->prepare($sql);
$query->execute();

confirmQuery($query);


while ($categories = $query->fetch(PDO::FETCH_ASSOC)){
        $category_id = $categories['id_cat'];
        $category_title = $categories['cat_title'];
        echo "<option value='{$category_id}'>{$category_title}</option>";
    }

?>
</select>

<!-- <label for="post_category">Post Category ID</label>
<input type="text" class="form-control" name="post_category_id" value="<?= $post_category_id ?>"> -->
</div>

<div class="form-group">
<label for="post_author">Author</label>
<input type="text" class="form-control" name="author" value="<?= $post_author ?>">
</div>

<div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status" value="<?= $post_status ?>">
</div>

<div class="form-group">
<label for="post_image">Post image</label><br>
<img width="100" src="../images/<?= $post_image ?>" alt="">
<input type="file" class="form-control" name="image" value="<?php echo $post_image ?>">
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags" value="<?= $post_tags ?>">
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?= $post_content ?>  
</textarea>
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_post" value="Update post">
</div>

</form>
</div>
