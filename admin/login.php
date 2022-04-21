<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login-Admin</title>
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
                height: 420px;
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
    <body>
        <div class="login">
            <img src="../images/img_avatar2.png" class="avatar">
            <h1>Login</h1>
            <form action="" method="POST">
                <p>UserName:</p>
                <input type="text" name="username" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" name="submit" value="Login">
                <a href="register.php">Register for new admin</a>
            </form>
        </div>
        
    </body>
</html>

<?php
    //check if submit button is clicked or not
    if(isset($_POST['submit'])){
        //to get the data
        $username = $_POST['username'];
        $password = $_POST['password'];

        //sql query to check username and password
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //execute the query
        $res = mysqli_query($conn ,$sql);

        //to count the rows
        $count = mysqli_num_rows($res);

        if($count==1){
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            //authorization
            $_SESSION['user'] = $username;
            //redirect to home page
            header('location:'.SITEURL.'admin/');
        }
        else{
            //user not available
            $_SESSION['login'] = "<div class='del'>Username and Password did not match.</div>";
            //redirect to home page
            header('location'.SITEURL.'admin/login.php');
        }


    }

?>