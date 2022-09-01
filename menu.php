<?php

  session_start();

  $itemcart = $_SESSION['order'];
  $restrict = $_SESSION['restrict'];

  require('capstone/dbconnect.php');

  $query1 = "SELECT banned_foods FROM student_tbl";
  $result = $conn->query($query1);
 
  while($row = $result->fetch_array())
  {
    $restrict = $row['banned_foods'];
  }
 $_SESSION['restrict'] = $restrict;


 //For checking purposes
 if(!empty($mod))
 {
   $_SESSION['mod'] = $_SESSION['mod'];
 }
 else
 {
   $mod = "";
   $_SESSION['mod'] = $mod;
 }


  //For Items
  if(!empty($itemcart))
  {
    $_SESSION['order'] = $_SESSION['order'];
  }
  else
  {
    $itemcart = array();
    $_SESSION['order'] = $itemcart;
  }

  //For Restrictions
  if(!empty($restrict))
  {
    $_SESSION['restrict'] = $_SESSION['restrict'];
  }
  else
  {
    $restrict = array();
    $_SESSION['restrict'] = $restrict;
  }


  //For Add to cart
  if(isset($_POST['addtocart']))
  {
	$id = $_POST['modal-qty-id'];

	if(empty($itemcart))
	{
		 $addNew = array($id => '1');
		 $itemcart = $itemcart + $addNew;
		
		 $_SESSION['order'] = $itemcart;

	}
	else
	{
		foreach($itemcart as $key => $value)
		{
			if($key == $id)
			{
				$itemcart[$key] = (int)$value + 1;
				$_SESSION['order'] = $itemcart;

			}
			else
			{
				$addNew = array($id => '1');
				$itemcart = $itemcart + $addNew;
			   
				$_SESSION['order'] = $itemcart;
				
        }
      }
    }
  }
  elseif(isset($_POST['addtorestrict']))
  {
	$id = $_POST['modal-qty-id'];

	$restrict = $_SESSION['restrict'];
	if(!empty(strchr($restrict, $id)))
	{
		echo "";
	}
	else
	{
		$id .= ',';
		
		if(empty($restrict))
		{
			 $restrict = $id;
		}
		else{
			$restrict = $restrict . $id;	
		}
	
		$sql = "UPDATE student_tbl SET banned_foods = '$restrict' WHERE student_id = '1' " ;
		
		if (mysqli_query($conn, $sql)) {
			echo "";
		  } else {
			echo "Error updating record: " . mysqli_error($conn);
		  }
		$_SESSION['restrict'] = $restrict;
	}
  }





  //Add button in modal
  if(isset($_POST['add-btn']))
  {
  $id = $_POST['modal-qty-id'];

  $itemcart = array();
  $itemcart = $_SESSION['order'];


  foreach($itemcart as $key => $value)
  {
    if($key == $id)
    {
      $itemcart[$key] = (int)$value + 1;
    }
    
  }
  $_SESSION['order'] = $itemcart; 
  $_SESSION['mod'] = 1;
  }

  //Minus button in modal
  if(isset($_POST['minus-btn']))
  {
  $id = $_POST['modal-qty-id'];

  $itemcart = array();
  $itemcart = $_SESSION['order'];



  foreach($itemcart as $key => $value)
  {
    if($key == $id)
    {
      if($itemcart[$key] == 1 || $itemcart[$key] == '1')
      {
        unset($itemcart[$id]);
      }
      else
      {
        $itemcart[$key] = (int)$value - 1;
      }
      
    }
    
  }
  $_SESSION['order'] = $itemcart; 
  $_SESSION['mod'] = 1;
  }

  //Delete  button in modal
  if(isset($_POST['del-btn']))
  {
  $id = $_POST['modal-qty-id'];
  $itemcart = $_SESSION['order'];

  unset($itemcart[$id]);
  $_SESSION['order'] = $itemcart;

  }




  

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MenuPo/Menu</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  <!-- Favicons -->
  <link href="assets/img/favicon/favicon.ico" rel="icon">
  <link href="assets/img/favicon/apple-touch-icon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="order.css?<?php echo time(); ?>">

  <!-- =======================================================
  * Template Name: Yummy - v1.1.0
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
       <img src="assets/img/logo.png" alt="">
        <h1>Menu<span>Po</span></h1>
      </a>

      <div class="box">
        <form name="search">
         <input type="text" class="input" name="txt" onmouseout="this.value = ''; this.blur();">
        </form>
         <i class="fas fa-search"></i>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="home.php#home">Home</a></li>
          <li><a href="menu.php#menu">Menu</a></li>
          <li><a href="#">History</a></li>
          <li><a href="#">Billing</a></li>
          <li class="dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="assets/img/avatar/user-dp.png" width="40" height="40" class="rounded-circle">
        </a>
            <ul class="listRight">
              <li><a href="user-account.php">My account</a></li>
              <li><a href="#">MyAnak</a></li>
              <li><a href="#">Switch account</a></li>
              <li><a href="login.php">Log out</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

      <?php 
        require('capstone/dbconnect.php');
        $query1 = "SELECT * FROM parent_tbl";
        $result = $conn->query($query1);
        
        while($row = $result->fetch_array())
        {
      
      ?>

        <div class="section-header">
          <h2>Our Menu</h2>
          <p>
          <?php date_default_timezone_set('Asia/Hong_Kong'); 
          $time = date("H");
          if((int)$time > 1  && (int)$time < 12 && (int)$time != 12 )
          {
            echo "Good Morning";
          }
          elseif((int)$time > 12  && (int)$time < 18)
          {
            echo "Good Afternoon";
          }
          elseif((int)$time > 18  && (int)$time < 24)
          {
            echo "Good Evening";
          }

           ?>
           <span><?php echo $row['parent_fn'] ?></span>
          </p>
        </div>

      <?php }?>

  <div class="container bg-white mx-0">
    <div class="navbar navbar-expand-md navbar-light bg-white">
      <div class="container-fluid p-0 d-flex flex-row"> 
          <a class="navbar-brand text-uppercase fw-800" href="#">
            <span class="border-red pe-2">SAMPLE SCHOOL NAME</span>CANTEEN MENU
          </a> 
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="fas fa-bars"></span> 
          </button>
          <div class="categ mb-3">
            <div class="categ-body">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                  <button class="nav-link active" id="nav-meal-tab" data-bs-toggle="tab" data-bs-target="#nav-meal" type="button" role="tab" aria-controls="nav-meal" aria-selected="true">Meals</button>

                  <button class="nav-link" id="nav-drinks-tab" data-bs-toggle="tab" data-bs-target="#nav-drinks" type="button" role="tab" aria-controls="nav-drinks" aria-selected="false">Drinks</button>

                  <button class="nav-link" id="nav-snacks-tab" data-bs-toggle="tab" data-bs-target="#nav-snacks" type="button" role="tab" aria-controls="nav-snacks" aria-selected="false">Snacks</button>

                  <button class="nav-link" id="nav-breads-tab" data-bs-toggle="tab" data-bs-target="#nav-breads" type="button" role="tab" aria-controls="nav-breads" aria-selected="false">Breads</button>

                  <button class="nani" id="btn"><i class="fa-solid fa-cart-shopping" style="font-size: 25px; padding-top: 15px"></i></button>
                </div>
              </nav>             
            </div>
          </div>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
      <!-- Start of Meal Cards -->
      <div class="tab-pane fade show active" id="nav-meal" role="tabpanel" aria-labelledby="nav-meal-tab">
        <div class="inner-row d-flex flex-row row row-cols-1 row-cols-md-5 g-4 ">
          <?php 
              require('capstone/dbconnect.php');

              $query1 = "SELECT * FROM meal_items_tbl WHERE type = 'Meal' && status = 1";
              $result = $conn->query($query1);
              
              while($row = $result->fetch_array())
              {

            ?>
            
              <div class="d-flex flex-column align-items-center justify-content-center product-item my-3 mx-3" style="width: 22%;">
                  <div class="product"> 
                    <img src="<?php echo $row['image']; ?>" alt="">
                    <form action="menu.php" method="POST">
                      <ul class="d-flex align-items-center justify-content-center list-unstyled icons">                   
                        <input type="hidden" name="modal-qty-id" value="<?php echo $row['meal_id'] ?>">
                        <?php
                         $name= "'".$row['name']."'";
                         $descrip = "'".$row['descrip']."'";

                         echo '<a onclick="infoBtn('.$name.','.$descrip.')"><li class="info-icon icon"><span class="fa-solid fa-circle-info"></span></li></a>';
                        
                        ?>
                        <button type="submit" name="addtorestrict" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip<br>Hello"><li class="restrict-icon icon mx-3"><span class="fa-solid fa-xmark"></span></li>
                        <button type="submit" name="addtocart"><li class="icon"><span class="fa-solid fa-cart-shopping"></span></li></button>
                        
                      </ul>
                    </form>
                  </div>
                  <div class="tag bg-green">fill the menu</div>
                  <div class="title pt-4 pb-1"><?php echo $row['name']; ?></div>
                  <div class="price">₱ <?php echo $row['price']; ?>.00</div>
              </div>  
            
          <?php } ?>
        </div>
      </div> 
      <!-- End of Meal Cards -->

      <!-- Start of Drinks Cards -->
      <div class="tab-pane fade" id="nav-drinks" role="tabpanel" aria-labelledby="nav-drinks-tab">
        <div class="inner-row d-flex flex-row">
          <?php 
                require('capstone/dbconnect.php');

                $query1 = "SELECT * FROM meal_items_tbl WHERE type = 'Drinks' && status = 1";
                $result = $conn->query($query1);
                
                while($row = $result->fetch_array())
                {

              ?>
              <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3 mx-3">
                  <div class="product"> 
                    <img src="<?php echo $row['image']; ?>" alt="">
                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                      <input type="hidden" name="modal-qty-id" value="<?php echo $row['meal_id'] ?>">
                        <?php
                         $name= "'".$row['name']."'";
                         $descrip = "'".$row['descrip']."'";

                         echo '<a onclick="infoBtn('.$name.','.$descrip.')"><li class="info-icon icon"><span class="fa-solid fa-circle-info"></span></li></a>';
                        
                        ?>
                        <button type="submit" name="addtorestrict"><li class="restrict-icon icon mx-3"><span class="fa-solid fa-xmark"></span></li>
                        <button type="submit" name="addtocart"><li class="icon"><span class="fa-solid fa-cart-shopping"></span></li></button>
                    </ul>
                  </div>
                  <div class="tag bg-green">fill the menu</div>
                  <div class="title pt-4 pb-1"><?php echo $row['name']; ?></div>
                  <div class="price">₱ <?php echo $row['price']; ?>.00</div>
              </div>  
            <?php } ?>
        </div>
      </div>
      <!-- End of Drinks Cards -->

      <!-- Start of Snacks Cards -->
      <div class="tab-pane fade" id="nav-snacks" role="tabpanel" aria-labelledby="nav-snacks-tab">
        <div class="inner-row d-flex flex-row">
          <?php 
                require('capstone/dbconnect.php');

                $query1 = "SELECT * FROM meal_items_tbl WHERE type = 'Snacks' && status = 1";
                $result = $conn->query($query1);
                
                while($row = $result->fetch_array())
                {

              ?>
              <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3 mx-3">
                  <div class="product"> 
                    <img src="<?php echo $row['image']; ?>" alt="">
                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                    <input type="hidden" name="modal-qty-id" value="<?php echo $row['meal_id'] ?>">
                        <?php
                         $name= "'".$row['name']."'";
                         $descrip = "'".$row['descrip']."'";

                         echo '<a onclick="infoBtn('.$name.','.$descrip.')"><li class="info-icon icon"><span class="fa-solid fa-circle-info"></span></li></a>';
                        
                        ?>
                        <button type="submit" name="addtorestrict" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip<br>Hello"><li class="restrict-icon icon mx-3"><span class="fa-solid fa-xmark"></span></li>
                        <button type="submit" name="addtocart"><li class="icon"><span class="fa-solid fa-cart-shopping"></span></li></button>
                    </ul>
                  </div>
                  <div class="tag bg-green">fill the menu</div>
                  <div class="title pt-4 pb-1"><?php echo $row['name']; ?></div>
                  <div class="price">₱ <?php echo $row['price']; ?>.00</div>
              </div>  
            <?php } ?>
        </div>
      </div>
      <!-- End of Snacks Cards -->

      <!-- Start of Bread Cards -->
      <div class="tab-pane fade" id="nav-breads" role="tabpanel" aria-labelledby="nav-breads-tab">
        <div class="inner-row d-flex flex-row">
          <?php 
                require('capstone/dbconnect.php');

                $query1 = "SELECT * FROM meal_items_tbl WHERE type = 'Breads' && status = 1";
                $result = $conn->query($query1);
                
                while($row = $result->fetch_array())
                {

              ?>
              <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3 mx-3">
                  <div class="product"> 
                    <img src="<?php echo $row['image']; ?>" alt="">
                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                    <input type="hidden" name="modal-qty-id" value="<?php echo $row['meal_id'] ?>">
                        <?php
                         $name= "'".$row['name']."'";
                         $descrip = "'".$row['descrip']."'";

                         echo '<a onclick="infoBtn('.$name.','.$descrip.')"><li class="info-icon icon"><span class="fa-solid fa-circle-info"></span></li></a>';
                        
                        ?>
                        <button type="submit" name="addtorestrict" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip<br>Hello"><li class="restrict-icon icon mx-3"><span class="fa-solid fa-xmark"></span></li>
                        <button type="submit" name="addtocart"><li class="icon"><span class="fa-solid fa-cart-shopping"></span></li></button>
                    </ul>
                  </div>
                  <div class="tag bg-green">fill the menu</div>
                  <div class="title pt-4 pb-1"><?php echo $row['name']; ?></div>
                  <div class="price">₱ <?php echo $row['price']; ?>.00</div>
              </div>  
            <?php } ?>
        </div>
      </div>
      <!-- End of Bread Cards -->
    </div>
    <div class="row">
     

      
    </div>        
  </div>
</div>
      </div>
    </section><!-- End Menu Section -->




    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container-fluid" data-aos="fade-up">

        <div class="section-header">
          <h2>Events</h2>
          <p>Share <span>Your Moments</span> In Our Restaurant</p>
        </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/events-1.jpg)">
              <h3>Custom Parties</h3>
              <div class="price align-self-start">$99</div>
              <p class="description">
                Quo corporis voluptas ea ad. Consectetur inventore sapiente ipsum voluptas eos omnis facere. Enim facilis veritatis id est rem repudiandae nulla expedita quas.
              </p>
            </div><!-- End Event item -->

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/events-2.jpg)">
              <h3>Private Parties</h3>
              <div class="price align-self-start">$289</div>
              <p class="description">
                In delectus sint qui et enim. Et ab repudiandae inventore quaerat doloribus. Facere nemo vero est ut dolores ea assumenda et. Delectus saepe accusamus aspernatur.
              </p>
            </div><!-- End Event item -->

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/events-3.jpg)">
              <h3>Birthday Parties</h3>
              <div class="price align-self-start">$499</div>
              <p class="description">
                Laborum aperiam atque omnis minus omnis est qui assumenda quos. Quis id sit quibusdam. Esse quisquam ducimus officia ipsum ut quibusdam maxime. Non enim perspiciatis.
              </p>
            </div><!-- End Event item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Events Section -->

  <!-- Order Summary Modal -->
<div class="modal " id="myModal"  data-toggle="modal" data-backdrop="true" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body text-start text-black p-4">
        <div class="close">
          <span class="close" id="close-button">&times;</span>
        </div>
        <h4 class="mb-5" style="color: #35558a;">Payment Summary</h4>
        <hr class="mt-2 mb-4"
          style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
        <?php
        {
          require('capstone/dbconnect.php');
          
          $cart = $_SESSION['order'];


          $totalPrice = 0;
          
          //For checking
          $mod = $_SESSION['mod'];


          if(!empty($mod))
          {
            //Kinukuha nya yung updated
            $itemcart = $_SESSION['order'];
          }
          else
          {
            //Kinukuha nya kung ilan yung duplicate 
            $itemcart = $cart;
          }

          $_SESSION['order'] = $itemcart;

          
          //Kinukuha nya yung keys *key : value kasi set up nung itemcartvals
          $itemcartkeys = array_keys($itemcart);
          ?>
          <div class="d-flex justify-content-between" style="padding-bottom: 10px;">
              <div class="item" style="width: 160px;">
                <p class="fw-bold mb-0">Item</p>
              </div>
              <div class="qty" style="width: 80px;">
                <p class="fw-bold mb-0">Qty</p>
              </div>
              <div class="price" style="width: 20px;">
                <p class="fw-bold mb-0">Price</p>
              </div>
              <div class="add-minus-button" style="width: 100px;">
                
              </div>
            </div>
          <?php
                        
          foreach($itemcartkeys as $val)
          {
            if($val != 0)
            {
              $query = "SELECT * FROM meal_items_tbl WHERE meal_id = '$val' ";
              $result = $conn->query($query);
                        
              while($row = $result->fetch_array())
              {
                $intVals = (float)$itemcart[$val];
                $priceVals = (float)$row['price'];
                $totalPrice += $intVals*$priceVals


              
          ?>
            <div class="d-flex justify-content-between">
              <div class="item" style="width: 160px;">
                <p class="fw-bold mb-0"><?php echo $row['name']?></p>
              </div>
              <div class="qty" style="width: 80px;">
                <p class="fw-bold mb-0"><?php echo $itemcart[$val]?> </p>
              </div>
              <div class="price" style="width: 20px;">
                <p class="text-muted mb-0"><?php echo $intVals*$priceVals; ?></p>
              </div>
              <div class="add-minus-button" style="width: 100px;">
                <form action="menu.php" method="POST" style="margin-left:30px;">
                  <input type="hidden" name="modal-qty-id" value="<?php echo $row['meal_id'] ?>">
                  <button type="submit" class="fa-solid fa-circle-plus" name="add-btn" ></button>
                  <button type="submit" class="fa-solid fa-circle-minus" name="minus-btn" ></button>
                  <button type="submit" class="fa-solid fa-circle-xmark" name="del-btn"></button>
                </form>
              </div>
              
            </div>
            <?php } ?>   
          <?php } ?> 
          <?php } ?> 

        <br>
        <hr class="mt-2 mb-4"
          style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
        <div class="total-div d-flex justify-content-between">
          <p class="fw-bold">Total</p>
          <p class="fw-bold" style="color: #35558a;"><?php echo $totalPrice; ?></p>
        </div>
        <?php } ?>
      </div>
      <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
        <?php
          if(!empty($_SESSION['order']))
          { ?>
            <a href="payment-links.php">
              <div class="button">
                <button type="button" class="modal-btn" name="submit" id="btn" >Checkout</button>
              </div>
            </a>
         <?php }
         ?>


      </div>
    </div>
  </div>
</div> 
  <!-- End of Order Summary Modal -->

  <!-- Food Info Modal -->
  
<div class="modal" id="food-info" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="food-info-title">Modal title</h5>
        <button type="button" class="btn-close" id="food-info-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="food-info-body">
        <p>Modal body text goes here.</p>
      </div>
    </div>
  </div>
</div>

  
  <!-- End of Food Info Modal -->


    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              School <br>
              Address<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact Us</h4>
            <p>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> menupo@gmail.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Canteen Hours</h4>
            <p>
              <strong>Mon-Sat: 11AM</strong> - 23PM<br>
              Sunday: Closed
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>MenuPo</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Developed by <a href="https://bootstrapmade.com/">TeamName</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="https://kit.fontawesome.com/d00886c359.js" crossorigin="anonymous"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="assets/js/main.js"></script>

  <!-- Script for Order Summary Modal -->
  <script>
  var orderSummaryModal = document.getElementById("myModal");
  var btn = document.getElementById("btn");



  //Opening the Order Summary modal
  document.getElementById('btn').onclick = function() 
  {
    orderSummaryModal.style.display = "block";
  }

  //Closing the Order Summary modal by clicking the x button
  document.getElementById('close-button').onclick = function() 
  {
    orderSummaryModal.style.display = "none";
  }

  function infoBtn(id, descrip)
  {
    document.getElementById('food-info').style.display = "block";
    document.getElementById('food-info-title').textContent = id;
    document.getElementById('food-info-body').textContent = descrip;

  }

  //Closing the Info modal by clicking the x button
  document.getElementById('food-info-close').onclick = function() 
  {
    document.getElementById('food-info').style.display = "none";
  }




</script>
 
  

</body>

</html>