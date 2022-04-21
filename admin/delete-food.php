<?php
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get id and image

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove image
        if($image_name!= "")
        {
            $path = "../images/food/".$image_name;

            $remove = unlink($path);

            if($remove==FALSE)
            {
                $_SESSION['upload'] = "<div class='del'>Failed to remove</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //delete from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn , $sql);

        //to check if query is executed or not
        //redirect to manage food with message
        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='del'>Failed to remove</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    else{
        
        $_SESSION['unauthorize'] = "<div class = 'del'>Access Not available</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }
?>