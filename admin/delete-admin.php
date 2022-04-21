<?php 

        include('../config/constants.php');

        // To get the id of admin to be deleted
        $id = $_GET['id'];

        // To create sql query to delete the admin
        $sql = "DELETE FROM tbl_admin WHERE id = $id";

        //To execute the query
        $res = mysqli_query($conn ,$sql);

        //check if query is executed successfully
        if($res==TRUE){
            // echo 'deleted';
            //create session variable to delete the message
            $_SESSION['delete'] = '<div class="del">Admin Deleted successfully</div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else {
            $_SESSION['delete'] = '<div class="del">Process Failed try Again</div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

        // To redirect to manage admin page with message (success/error)

?>