<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>
        <?php
            //to get the id
            $id=$_GET['id'];

            //create the query
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //execute the query
            $res=mysqli_query($conn, $sql);

            //check if query is executed
            if($res==true){
                $count = mysqli_num_rows($res);
                //check if we have admin data or not
                if($count==1){
                    //get the details
                    echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    //redirect to admin page
                    header('localhost'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action=""method="POST">
            <table class="table-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit"name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
    //check if the submit button is clicked or not
    if(isset($_POST['submit'])){
        //get all the value from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //sql query
        $sql = "UPDATE tbl_admin SET full_name = '$full_name', 
        username = '$username' 
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        //check if query is executed or not
        if($res==true){
            $_SESSION['update'] = '<div class="success">Admin Updated successfully</div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
            
        }
        else{
            $_SESSION['update'] = '<div class="success">Error in updating</div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        
    }
?>

<?php include('partials/footer.php');?>