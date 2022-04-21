<?php include('partials/menu.php');?>

<div class="main-content">
        <div class="wrapper">
            <h1>Food Management</h1>
            <br>
                <br>
                <a href="<?php echo SITEURL; ?>admin/add-food.php"class="btn-primary">ADD FOOD</a>
                <br>
                <br>

                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }
                
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>Serial no.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // create sql query to get all the food
                        $sql = "SELECT * FROM tbl_food";

                        $res = mysqli_query($conn , $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count>0)
                        {
                            // get food from data base and displayes
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                     
                            
    
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                    <?php 
                                        //to check image name is available or not
                                        if($image_name!=""){
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php
                                            echo $image_name; ?>"width = "150px">
                                            <?php
                                        }
                                        else{
                                            echo "<div class='del'>Image not Available</div";
                                        }
                                    ?>
                                </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                      <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"class="btn-secondary">Update Food</a>
                                      <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>
                                      &image_name=<?php echo $image_name; ?>"class="btn-danger">Delete Food</a>
                                  </td>
                            </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr> <td colspan='7' class ='del'> food not add yet.</td></tr>";
                        }
                        
                        ?>

                    <!-- <tr>
                        <td>1.</td>
                        <td>Burger King</td>
                        <td>Rs 50</td>
                        <td>Image</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td>
                            <a href=""class="btn-secondary">Update Admin</a>
                            <a href=""class="btn-danger">Delete Admin</a>
                        </td>
                    </tr> -->
                </table>
        </div>
</div>

<?php include ('partials/footer.php');?>