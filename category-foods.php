<?php include('partials-front/menu.php') ?>

<?php
// check id is pass or not
    if(isset($_GET['category_id']))
    {
        //category is is set and get id 
        $category_id = $_GET['category_id'];

        //get category title based on category ID 
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //tun the query 
        $res = mysqli_query($conn, $sql);

        //get the value form data base
        $row = mysqli_fetch_assoc($res);

        // get title
        $category_title = $row['title'];
            


    }
    else
    {
        // category is not pass
        //go to home page
        header('location:'.SITEURL);

    }
?>

    <section class="food-search text-center">
        <div class="container">
            <h2>Foods on <a href="#" class ="text-white">"<?php echo $category_title ; ?>"</a></h2>

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // sql query for get foods based on select 
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //run the query
                $res2 =mysqli_query($conn,$sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);

                //check food is available or not
                if($count2>0)
                {
                    //food availble
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    if($image_name="")
                                    {
                                        //not image found
                                        echo "<div class'error'>Image not Available</div>";

                                    }
                                    else
                                    {
                                        //image found
                                       ?>
                                       <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ?>" 
                                    alt="" class="img-responsive img-curve">
                                       <?php
                                       


                                    }


                                    ?>
                                   
                                </div>
                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price">$<?php echo $price; ?></p>
                                        <p class="food-detail">
                                            Lorem ipsum dolor sit amet..
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                        <?php

                    }

                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food is not Availble</div>";

                }
            ?>

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>