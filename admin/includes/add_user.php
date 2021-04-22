<?php

if(isset($_POST['create_user'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];  
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    
    move_uploaded_file($user_image_temp,"../images/$user_image");

    $sql = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role, user_image)
            VALUES ('{$username}','{$password}','{$firstname}','{$lastname}','{$email}','{$role}','{$user_image}')";
    
    $query = $db->prepare($sql);
    $query->execute();

    header("Location: users.php");
}
?>

<div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="password">
</div>

<div class="form-group">
<label for="firstname">First Name</label>
<input type="text" class="form-control" name="firstname">
</div>

<div class="form-group">
<label for="lastname">Last Name</label>
<input type="text" class="form-control" name="lastname">
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" name="email">
</div>

<div class="form-group">
<label for="user_image">User image</label>
<input type="file" class="form-control" name="user_image">
</div>

<div class="form-group">
<label for="role">User role</label>
<select name="role" id="">
<option value="admin">Administrator</option>
<option value="user">User</option>
<option value="guest">Guest</option>
</select>
</div>


<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_user" value="Create new user">
</div>

</form></div>