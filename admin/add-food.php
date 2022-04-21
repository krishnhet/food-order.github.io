<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="table-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food" ></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>


                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                        <?php

                        //get category from data base
                        //1 make sql for get category from data base 
                        $sql= "SELECT * FROM tbl_category WHERE active='Yes' ";

                        // write in php for data base
                        $res =mysqli_query($conn, $sql);

                        //count row to check  wherter  we have  category  or not
                        $count=mysqli_num_rows($res);

                        //if count is greter than 0 then we category  else  we don't have  category
                        if($count>0)
                        {
                            //we have category
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get deatils of category
                                $id=$row['id'];
                                $title= $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php

                            }
                        }
                        else
                        {
                            //we don't have category
                          ?>
                          <option value="0">No Category Found</option>
                          <?php
                           
                        }

                        //2 disply  it oacn dropdown manu
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </tr>

            </table>
        </form>

        <?php
        // for submit is clickes or not\
        if(isset($_POST['submit']))
        {
            //then add food in data base
            echo "clicked";
            
            //get  data from form which we have filled
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else{
                $featured = "No";
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }

            //uploads image if selected
            if(isset($_FILES['image']['name']))
            {
                //get deatils of image 
                $image_name = $_FILES['image']['name'];

               if($image_name!="")
               {
                   $ext =end(explode('.',$image_name));

                   $image_name = "Food-name-".rand(0000,9999).".".$ext;

                   $src = $_FILES['image']['tmp_name'];

                   $dst = "../images/food/".$image_name;

                   //upload the image
                   $upload = move_uploaded_file($src,$dst);

                   if($upload==FALSE){
                       $_SESSION['upload'] = "<div class='del'>Failed to upload image</div>";
                       header('location:'.SITEURL.'admin/add-food.php');
                       die();
                   }
                }
                
            }
            else
            {
                $image_name = ""; 
            
            }
                    //insert into data base
                $sql2 = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = $price, 
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                        
                ";
            
                // run query
                $res2 = mysqli_query($conn,$sql2);

                if($res2 == TRUE){
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    $_SESSION['add'] = "<div class='success'>Failed to Add Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
        }
        ?>
</div>

</div> 

<?php include('partials/footer.php'); ?>