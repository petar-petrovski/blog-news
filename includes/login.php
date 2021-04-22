<?php 

include "db.php"; 
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    
    // $sql->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = "SELECT * FROM users WHERE username = '{$username}'";    
    $query = $db->prepare($sql);
    $query->execute();
//     $check_user = $query->fetch(PDO::FETCH_ASSOC);

// print_r ($check_user);
// die();
    while ($user = $query->fetch(PDO::FETCH_ASSOC)){

        $db_user_id = $user['user_id'];
        $db_username = $user['username'];
        $db_user_password = $user['user_password'];
        // $user_email = $user['user_email'];
        $db_user_firstname = $user['user_firstname'];
        $db_user_lastname = $user['user_lastname'];
        // $user_image = $user['user_image'];

        $db_user_role = $user['user_role'];
    }

    if($username !== $db_username && $password !== $db_user_password){
        header("Location: ../index.php");
    } else if($username == $db_username && $password == $db_user_password){
        $_SESSION['username'] = $db_username;
        // $_SESSION['password'] = $db_user_password;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['role'] = $db_user_role;

        header("Location: ../admin/index.php");
    } else {
        header("Location: ../index.php");
    }
}

