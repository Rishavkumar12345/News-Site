<?php

    include 'config.php';
    if(empty($_FILES['new-image']['name'])){
        $new_name=$_POST['old_image'];
    }else{
        $errors = array();

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_ext = end(explode('.',$file_name));

        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false)
        {
            $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
        }

        if($file_size > 2097152){
            $errors[] = "File size must be 2mb or lower.";
        }

        if($file_size > 2097152){
            $errors[] = "File size must be 2mb or lower.";
        }
        $new_name = time(). "-".basename($file_name);
        $target = "upload/".$new_name;
        $image_name = $new_name;
        if(empty($errors) == true){
            move_uploaded_file($file_tmp,$target);
        }else{
            print_r($errors);
            die();
        }
    }

    $new_title=$_POST['post_title'];
    $new_desc=$_POST['postdesc'];
    $new_cat=$_POST['category'];
    
    $sql="UPDATE post SET title='{$new_title}',description='{$new_desc}',category={$new_cat},post_img='{$image_name}' where post_id={$_POST["post_id"]}";

    $result = mysqli_query($conn,$sql) or die("query failed");

    if($result){
    header("location: {$hostname}/admin/post.php");
    }else{
    echo "Query Failed";
    }
?>