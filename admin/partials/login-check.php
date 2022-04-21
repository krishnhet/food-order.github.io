
<?php
    //to check if user is logged in or not for authorizarion
    if(!isset($_SESSION['user']))
    {
        //user is not logged in
        $_SESSION['no-login-message'] = "<div class='del'>Please login to access</div>";
        //redirect
        header('location:'.SITEURL.'admin/login.php');
    }
?>