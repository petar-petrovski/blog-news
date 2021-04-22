<?php   include "includes/admin_header.php"; ?>
<?php

if(isset($_SESSION['username'])){

    $username = $_SESSION['username'];
    // $user_password = $_SESSION['password'];
    // $user_firstname = $_SESSION['firstname'];
    // $user_lastname = $_SESSION['lastname'];

    $sql = "SELECT * FROM users WHERE username = '{$username}'"; 
    $query = $db->prepare($sql);
    $query->execute();
    $all_users = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($all_users as $user){


        $user_id = $user['user_id'];
        $username = $user['username'];
        $user_password = $user['user_password'];
        $user_email = $user['user_email'];
        $user_firstname = $user['user_firstname'];
        $user_lastname = $user['user_lastname'];
        $user_image = $user['user_image'];

        $user_role = $user['user_role'];

    }
}

if (isset($_POST['edit_user'])){

    $username = $_POST['username'];
    //update session name
    $_SESSION['username'] = $_POST['username'];

    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp,"../images/$user_image");

    if(empty($user_image)){

        $sql = "SELECT * FROM users WHERE user_id = '{$user_id}'";
        $query = $db->prepare($sql);
        $query->execute();
        while ($user_data = $query->fetch(PDO::FETCH_ASSOC)){

        $user_image = $user_data['user_image'];

        // echo $new_user_image;
        // die();
        }
    }

    $sql = "UPDATE users 
            SET username = '{$username}', 
                user_password = '{$password}', 
                user_firstname = '{$firstname}', 
                user_lastname = '{$lastname}',
                user_image = '../images/{$user_image}',
                user_email = '{$email}', 
                user_role = '{$role}'
                
            WHERE user_id = '{$user_id}'"; 

    $query = $db->prepare($sql);
    $query->execute();
}
?>

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
Profile
            </h1>
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
