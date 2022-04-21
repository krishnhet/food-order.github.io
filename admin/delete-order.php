<?php
    include('../config/constants.php');

    $id = $_GET['id'];

    //Delete Order Data from Database
    $sql = "DELETE FROM tbl_order WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete'] = "<div class='success'>Order Deleted</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else{
        $_SESSION['delete'] = "<div class='success'>Failed to delete</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
?>