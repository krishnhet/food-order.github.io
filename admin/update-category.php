<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br> <br>

        <?php
            //to check if id is set or not
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                //to create sql to get details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //to execute the query
                $res = mysqli_query($conn , $sql);

                $count = mysqli_num_rows($res);

                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no-category-found'] = "<div class='del'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }


            }
            else{
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>




        <form action="" method="POST" enctype="multipart/form-data">
        <table class="table-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title ?>">
                </td>
            </tr>

            <tr>
                <td>Image:</td>
                <td>
                    <?php
                        if($current_image != ""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>"width="125px">

                            <?php
                        }
                        else{
                            echo "<div class='del'>Image Not Added</div>";
                        }
                    ?>
                </td>
            </tr>

            <!-- <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr> -->

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>

            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>

            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category"class="btn-secondary">
                </td>
            </tr>

        </table>
    </form>

    <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];



                    //updating if new image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                    //upload if image is selected
                        if($image_name!="")
                        {
                        }
                            
                    }
                    else{
                        $image_name = $current_image;
                    }
                    //update the database
                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    ";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==TRUE)
                    {
                        $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else{
                        $_SESSION['update'] = "<div class='del'>Failed to Update Category</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>