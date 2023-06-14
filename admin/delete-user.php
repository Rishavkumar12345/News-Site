<?php 

if($_SESSION['user_role']=='0'){
    header("Location: {$hostname}/admin/post.php");
}
    include 'config.php';
    $uid=$_GET['id'];

    $sql="DELETE FROM user where user_id={$uid}";

    if(mysqli_query($conn,$sql)){
        header("Location: {$hostname}/admin/users.php");
    }
?>