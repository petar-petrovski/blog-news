
<form><button style="position:relative; float:right;" class="btn btn-primary"><a href="users.php?source=add_user" style="color:white; text-decoration: none;">Add new user</a></button></form><br><br>
<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Image</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                        <!-- <th colspan="2" style="text-align: center;">Actions</th> -->
                    </tr>
                </thead>
                <tbody>

<?php 

$sql = "SELECT * FROM users ORDER BY user_id DESC"; 
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


        echo "<tr><td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_password}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td><img src='../images/{$user_image}' alt='image' width='auto' height='70'></td>";
        echo "<td>{$user_role}</td>";     
        
        echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td></tr>";
        
    }
?>
                </tbody>
            </table>
            

<?php
    //delete user
    if(isset($_GET['delete'])){
        $delete_user_id = $_GET['delete'];

        $sql = "DELETE FROM users WHERE user_id = {$delete_user_id}";

        $query = $db->prepare($sql);
        $query->execute();

        header("Location: users.php");
    }

?>