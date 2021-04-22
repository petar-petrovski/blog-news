<?php

function insert_category() {
    global $db;

    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            This field should not be empty!</div>";
        } else {
            
            $sql = "INSERT INTO categories (cat_title) VALUES ('$cat_title')"; 
            $query = $db->prepare($sql);
            $query->execute();
            // $create_cat = $query->fetch(PDO::FETCH_ASSOC);

            if(!$query) {
                die("Error adding category!");
            } else {
                echo "<div class=\"alert alert-success\" role=\"alert\">
                You have succesfully added new category!</div>";

            }
        }
        
    }
}

function findAllCategories(){ //display all categories
    global $db;

    
    $sql = "SELECT * FROM categories"; 
    $query = $db->prepare($sql);
    $query->execute();
    $select_categories = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($select_categories as $category){
    $cat_id = $category ['id_cat'];
    $cat_title = $category ['cat_title'];
    echo "<tr><td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete </a>| ";
    echo "<a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";
}

function deleteCategory(){
    global $db;

    if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];

        $sql = "DELETE FROM categories WHERE id_cat = {$del_id}"; 
        $query = $db->prepare($sql);
        $query->execute();

        header("Location: categories.php");
    }
}
}

function confirmQuery($result){
    global $db;

    if(!$result){
        die("query failed");
    }
}

function pre($print_pre){
echo "<pre>";
print_r($print_pre);
echo "</pre>";
}