<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            //get the serch key word
            $search = $_POST['search'];

        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            
            <?php
            //get search key word

            $search = $_POST['search'];

            //sql query for get foods from search which is in data base
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //run query
            $res = mysqli_query($conn, $sql);

            // count rows
            $count = mysqli_num_rows($res);

            //check food is avalable or not in database

            if($count>0)
            {
                //food avalable
                while($row=mysqli_fetch_assoc($res))
                {
                    // get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                         //check image name is avlable or not
                         if($image_name=="")
                         {
                             //image not avalable
                             echo "<div class = 'error'>Image not Available</div>";

                         }
                         else
                         {
                             //image available
                             ?>
                             <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Dosa" class="img-responsive img-curve">
                             <?php
                         }


                        ?>



                       
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                           <?php echo $description;  ?>
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
                // food not avalable
                echo "<div class='error'>Food not Found.</div>";

            }

            ?>

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>