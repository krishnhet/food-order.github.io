<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br> <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                echo($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                echo($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="table-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title"placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            //check if submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //get the value from category form
                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No";
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }

                //to check if image is selected or not and set the value for image name
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    //upload if image is selected
                    if($image_name!=""){

                    
                        //to rename image and after get the extension of our image name jpg/png
                        $ext = end(explode('.',$image_name));

                        //rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        if($upload==FALSE){
                            $_SESSION['upload'] = "<div class = 'error'>Failed to Upload</div>";

                            header('location:'.SITEURL.'admin/add-category.php');

                            die();
                        }
                    }
                }
                else{
                    $image_name="";
                }


                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name = '$image_name',
                    featured='$featured',
                    active = '$active'

                ";

                $res = mysqli_query($conn, $sql);

                if($res==TRUE)
                {
                    $_SESSION['add'] = "<div class = 'success'>Category Added Sucessfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else{
                    $_SESSION['add'] = "<div class = 'success'>Failed to Add Category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
        
    </div>
</div>

<?php include('partials/footer.php'); ?>