
<?php include('partials/menu.php');?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Admin Management</h1>
                <br>
                
                <?php 
                    if(isset($_SESSION['add']))
                    { 
                        echo $_SESSION['add']; //add the session message
                        unset($_SESSION['add']); //remove the session message
                    }
                    if(isset($_SESSION['delete']))
                    { 
                        echo $_SESSION['delete']; //add the session message
                        unset($_SESSION['delete']); //remove the session message
                    }
                    if(isset($_SESSION['update']))
                    { 
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']); 
                    }

                ?>
                <br>
                <br>
                <a href="add-admin.php"class="btn-primary">ADD ADMIN</a>
                <br>
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>Serial no.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>


                    <?php
                        //Query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the query
                        $res = mysqli_query($conn,$sql); 

                        //to check if query is executed or not
                        if($res==TRUE)
                        {
                            //count the rows to check if we have data in database or not
                            $count = mysqli_num_rows($res); // to get all row in database

                            $sn=1; //create the variable
                            //check the num of rows
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    //display value in table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <!-- <a href=""class="btn-primary">Change Password</a> -->
                                            <a href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id; ?>
                                            "class="btn-secondary">Update Admin</a>



                                            <a href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php
                                            echo $id; ?>"class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
        <!-- Main Content Section Ends -->
<?php include('partials/footer.php');?>