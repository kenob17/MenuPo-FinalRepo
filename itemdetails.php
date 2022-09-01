<?php
session_start();

$itemcart = $_SESSION['order'];

 require('capstone/dbconnect.php');

 $query1 = "SELECT banned_foods FROM student_tbl";
 $result = $conn->query($query1);

 while($row = $result->fetch_array())
 {
   $restrict = $row['banned_foods'];
 }
$_SESSION['restrict'] = $restrict;



if(isset($_POST['addtocart']))
{
	$id = $_POST['addtocart'];

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
	$id = $_POST['addtorestrict'];
	

	
	$restrict = $_SESSION['restrict'];
	if(!empty(strchr($restrict, $id)))
	{
		echo "Found copy";
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
		echo $restrict;
	
		$sql = "UPDATE student_tbl SET banned_foods = '$restrict' WHERE student_id = '1' " ;
		
		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully";
		  } else {
			echo "Error updating record: " . mysqli_error($conn);
		  }
		$_SESSION['restrict'] = $restrict;
	}

	
}





//figure out session variable



?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eCommerce Product Detail</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="itemdetails.css?<?php echo time(); ?>" rel="stylesheet">
	<script src="https://kit.fontawesome.com/269238eb9d.js" crossorigin="anonymous"></script>
  </head>

  <body>

	<?php
	{
		$id = $_GET['a']; 

		require('capstone/dbconnect.php');

		$query1 = "SELECT * FROM meal_items_tbl WHERE meal_id = $id";
		$result = $conn->query($query1);
		
		while($row = $result->fetch_array())
		{

	

	?>
	
  	<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="container-contents row gx-4 gx-lg-5 align-items-center">
                    <div class="image-class col-md-6">
						<img class="card-img-top mb-5 mb-md-0" src="<?php echo $row['image']; ?>" alt="..." />
					</div>

                    <div class="col-md-6">
                        <div class="dish-num mb-1">Dish-Id: <?php echo $row['meal_id']; ?></div>
                        <h1 class="dish-name display-5 fw-bolder"><?php echo $row['name']; ?></h1>
                        <div class="fs-5 mb-5">
                            <span class="dish-price"><i class="fa-solid fa-peso-sign"></i><?php echo $row['price']; ?>.00</span>
                        </div>
                        <p class="descrip"><?php echo $row['descrip']; ?></p>
						<form action="itemdetails.php?a=<?php echo $row['meal_id']; ?>" method="POST">
							<div class="btn-class d-flex py-20 ">
								<div class="row">
									<div class="col">
							
										<button class="btn btn-outline-dark " name="addtocart" type="submit" value="<?php echo $id; ?>">
											Add to cart
										</button>
									</div>
									<div class="col">
									
										<button class="btn btn-outline-dark " name="addtorestrict" type="submit" value="<?php echo $id; ?>">
											Add to restriction
										</button>
									</div>
									<div class="col">
									<a href="menu.php">
										<button class="btn btn-outline-dark " name="redirect" type="button">
											Back to menu
										</button></a>
									</div>

								</div>

							</div>
						</form>
                    </div>
                </div>
            </div>
    </section>
	<?php } }?>
  </body>
</html>
