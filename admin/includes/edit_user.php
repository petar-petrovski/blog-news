<?php

if(isset($_GET['u_id'])){
    $u_id = $_GET['u_id'];


    $sql = "SELECT * FROM users WHERE user_id = {$u_id}"; 
    $query = $db->prepare($sql);
    $query->execute();
    $edit_user = $query->fetch(PDO::FETCH_ASSOC);

    // print_r($edit_post);
    $user_id = $edit_user['user_id'];
    $username = $edit_user['username'];
    $user_password = $edit_user['user_password'];
    $user_email = $edit_user['user_email'];
    $user_firstname = $edit_user['user_firstname'];
    $user_lastname = $edit_user['user_lastname'];
    $user_image = $edit_user['user_image'];

    $user_role = $edit_user['user_role'];

}

if (isset($_POST['edit_user']) && isset($_GET['u_id'])){
    $u_id = $_GET['u_id'];
    // pre($_POST);
    // die();
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $new_firstname = $_POST['firstname'];
    $new_lastname = $_POST['lastname'];
    $new_email = $_POST['email'];
    $new_role = $_POST['role'];
    
    $new_user_image = $_FILES['user_image']['name'];
    $new_user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($new_user_image_temp,"../images/$new_user_image");

    if(empty($new_user_image)){

        $sql = "SELECT * FROM users WHERE user_id = $u_id";
        $query = $db->prepare($sql);
        $query->execute();
        while ($user_data = $query->fetch(PDO::FETCH_ASSOC)){

        $new_user_image = $user_data['user_image'];

        // echo $new_user_image;
        // die();
        }
    }

    $sql = "UPDATE users 
            SET username = '{$new_username}', 
                user_password = '{$new_password}', 
                user_firstname = '{$new_firstname}', 
                user_lastname = '{$new_lastname}',
                user_image = '../images/{$new_user_image}',
                user_email = '{$new_email}', 
                user_role = '{$new_role}'
                
            WHERE user_id = {$u_id}"; 

    $query = $db->prepare($sql);
    $query->execute();

    // echo $query;
    // die();
    header("Location: users.php");
    
}

?>


<div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username" value="<?= $username ?>">
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="password" value="<?= $user_password ?>">
</div>

<div class="form-group">
<label for="firstname">First Name</label>
<input type="text" class="form-control" name="firstname" value="<?= $user_firstname ?>">
</div>

<div class="form-group">
<label for="lastname">Last Name</label>
<input type="text" class="form-control" name="lastname" value="<?= $user_lastname ?>">
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" name="email" value="<?= $user_email ?>">
</div>

<div class="form-group">
<label for="user_image">User image</label></br>
<img width="100" src="../images/<?= $user_image ?>" alt="">
<input type="file" class="form-control" name="user_image" value="">
</div>

<div class="form-group">
<label for="role">User role</label>
<select name="role" id="">

<option value="<?= $user_role ?>" ><?= $user_role ?></option>
<?php 

if($user_role == 'admin'){
    echo "<option value='user'>User</option>";
    echo "<option value='guest'>Guest</option>";
}
if($user_role == 'user'){
    echo "<option value='admin'>Admin</option>";
    echo "<option value='guest'>Guest</option>";
}
if($user_role == 'guest'){
    echo "<option value='admin'>Admin</option>";
    echo "<option value='user'>User</option>";
}

?>
<!-- <option value="admin">Administrator</option>
<option value="guest">Guest</option> -->
</select>
</div>


<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Update">
</div>

</form></div>