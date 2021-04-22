<form action="" method="post">
<div class="form-group">
    <label for="cat_title">Edit Category</label>

    <?php 
     if(isset($_GET['edit'])){
        $edit_id = $_GET['edit'];



    $sql = "SELECT * FROM categories WHERE id_cat = $edit_id"; 
    $query = $db->prepare($sql);
    $query->execute();

    while ($category_values = $query->fetch(PDO::FETCH_ASSOC)){
            $edit_title = $category_values['cat_title'];
        }

?>
<input type="hidden" name="edit_id" id="" value="<?= $edit_id ?>">
<input class="form-control" type="text" name = "cat_title" value="<?php if(isset($edit_title)){ echo $edit_title;}  ?>">
<?php } ?>



<?php
if(isset($_POST['edit'])){
    // print_r($_POST);
    // die();

$update_title = $_POST['cat_title'];
$update_title_id = $_POST['edit_id'];


$sql = "UPDATE categories SET cat_title = '{$update_title}' WHERE id_cat = {$update_title_id}"; 
$query = $db->prepare($sql);
$query->execute();

// print_r($query);
// die();

// if (!$query) {
//     echo 'query failed';
// }
header("Location: categories.php");
}
if(isset($_POST['cancel'])){
    header("Location: categories.php");
}
?>
   
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" name = "edit" value="Edit category">
    <input class="btn btn-primary" type="submit" name = "cancel" value="Cancel">

</div>
</form>
