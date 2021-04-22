<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In response to</th>
                        <th>Date</th>
                        <th>Approved</th>
                        <th>Unapproved</th>
                        <th>Delete</th>
                        
                        <!-- <th colspan="2" style="text-align: center;">Actions</th> -->
                    </tr>
                </thead>
                <tbody>

<?php 

$sql = "SELECT * FROM comments ORDER BY comment_id DESC"; 
    $query = $db->prepare($sql);
    $query->execute();
    $all_comments = $query->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($all_posts);
    // echo '</pre>';
    // die();
    foreach ($all_comments as $comment){


        $comment_id = $comment['comment_id'];
        $comment_post_id = $comment['comment_post_id'];
        $comment_author = $comment['comment_author'];
        $comment_email = $comment['comment_email'];
        $comment_content = $comment['comment_content'];
        $comment_status = $comment['comment_status'];
        $comment_date = $comment['comment_date'];


        echo "<tr><td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";

        // $sql = "SELECT * FROM categories WHERE id_cat = $post_cat"; 
        // $query = $db->prepare($sql);
        // $query->execute();
    
        // while ($category_values = $query->fetch(PDO::FETCH_ASSOC)){
        //         $cat_id = $category_values['id_cat'];
        //         $cat_title = $category_values['cat_title'];
            

        //         echo "<td>{$cat_title}</td>";
        //     }



        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";
        
        $sql = "SELECT * FROM posts WHERE post_id = $comment_post_id"; 
        $query = $db->prepare($sql);    
        $query->execute();
        
        while ($comment_post = $query->fetch(PDO::FETCH_ASSOC)){
                $post_id = $comment_post['post_id'];
                $comment_post_title = $comment_post['post_title'];
        
        echo "<td><a href='../post.php?p_id=$post_id'>$comment_post_title</a></td>";

    }

        echo "<td>{$comment_date}</td>";
        
        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td></tr>";
        
    }
?>
                </tbody>
            </table>
            

<?php
    //unapprove comment
    if(isset($_GET['unapprove'])){
        $unapprove_id = $_GET['unapprove'];
        

        $sql = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_id}";

        $query = $db->prepare($sql);
        $query->execute();

        header("Location: comments.php");
    }

    //approve comment
    if(isset($_GET['approve'])){
        $approved_id = $_GET['approve'];
        

        $sql = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approved_id}";

        $query = $db->prepare($sql);
        $query->execute();

        header("Location: comments.php");
    }

    //delete comment
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];

        $sql = "DELETE FROM comments WHERE comment_id = {$delete_id}";

        $query = $db->prepare($sql);
        $query->execute();

        $sql = "UPDATE posts
        SET post_comment_count = post_comment_count - 1
        WHERE post_id = '{$delete_id}'";
        
        $query = $db->prepare($sql);
        $query->execute();
        header("Location: comments.php");
    }

?>