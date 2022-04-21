<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Register-Admin</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background: url('../images/pic.jfif');
                background-size: cover;
                background-position: center;
                font-family: sans-serif;
            }
            .login{
                width: 320px;
                height: 435px;
                background: rgba(0, 0, 0, 0.342);
                top: 50%;
                left: 50%;
                position: absolute;
                transform: translate(-50%,-50%);
                box-sizing: border-box;
                padding: 70px 30px;
            }
            .avatar{
                width: 100px;
                height: 100px;
                border-radius: 50%;
                position: absolute;
                top: -50px;
                left: calc(50% - 50px);
                
            }
            h1{
                margin: 0;
                padding: 0 0 20px;
                text-align: center;
                font-size: 22px;
            }
            .login p{
                margin: 0;
                padding: 0;
                font-weight: bold;
            }
            .login input{
                width: 100%;
                margin-bottom: 20px;
            }
            .login input[type="text"] , input[type="password"]
            {
                border: none;
                border-bottom: 1px solid #fff;
                background: transparent;
                outline: none;
                height: 40px;
                color: #fff;
                font-size: 16px;
            }
            .login input[type="submit"]{
                border: none;
                height: 40px;
                background: #fb2525;
                color: #fff;
                font-size: 18px;
                border-radius: 20px;
            }
            .login input[type="submit"]:hover{
                cursor: pointer;
                background: #ffc107;
                color: #000;
            }
            .login a{
                text-decoration: none;
                color: blue;
            }
        </style>
        
    </head>
    <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
    <body>
        <div class="login">
            <img src="../images/img_avatar2.png" class="avatar">
            <h1>Register</h1>
            <form action="" method="POST">
                <p>FullName:</p>
                <input type="text" name="full_name" placeholder="Enter Fullname">
                <p>UserName:</p>
                <input type="text" name="username" placeholder="Enter Fullname">
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" name="submit" value="Register">
                <a href="login.php">Sign In</a>
            </form>
        </div>
        
    </body>
</html>
<?php
    //Process and save it in database

    // if submit button is clicked or not

    if(isset($_POST['submit']))
    {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password']; 

        //Query to save data from database
        $sql = "INSERT INTO tbl_admin SET
                full_name = '$full_name',
                username = '$username',
                password = '$password'
            ";

        //To execute query and save it in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check if data or query is inserted or executed or not

        if($res==TRUE)
        {
            $_SESSION['add'] = "Admin added successfully";
            //redirect the page
            header("location:".SITEURL.'admin/login.php');
        }
        else{
            $_SESSION['add'] = "Failed to add admin";
            //redirect the page
            header("location:".SITEURL.'admin/register.php');
        }
    }
?>