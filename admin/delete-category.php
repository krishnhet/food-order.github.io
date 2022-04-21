<?php 

    include('../config/constants.php');
    //to check if id and image is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name !=""){
            $path = "../images/category/".$image_name;
            // we have use inbuilt function unlink
            $remove  = unlink($path);

            if($remove==FALSE){
                //to stop the process
                $_SESSION['remove'] = "<div class='del'>Failed to remove</div>";

                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }
        //delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Category Deleted</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete'] = "<div class='success'>Failed to delete</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>