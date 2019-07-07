<?php

include("connection.php");

if(isset($_REQUEST["aid"]))
       {
	     $_SESSION["CategoryId"]=$_REQUEST["aid"]; 
       }

if(isset($_REQUEST["pid"]))
  {
   $sql="INSERT INTO  tbl_cart(Qty,ProductId,UserId) VALUES (1,'".$_REQUEST["pid"]."','".$_SESSION["RegId"]."') ";
   mysqli_query($con,$sql);  
  }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	
	<?php
	include("LoginHeader.php");
	
	?>
	
	
	<?php
	include("slider.php");
	?>
	
	
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
					<?php
					include("category.php");
					
					?>
						
					<?php
					include("brands.php");
					
					?>
						
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<?php
								
								$sql="SELECT * FROM tbl_product WHERE CategoryId='".$_SESSION["CategoryId"]."'   ";
								$result=mysqli_query($con,$sql);
								while($row=mysqli_fetch_array($result))
								{
								?>
						
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								
								
								
								
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php  echo $row['PhotoUrl'];  ?>" alt=""  />
											<h2><?php echo $row['Price'];   ?></h2>
											<p><?php  echo $row['ProductName'];  ?></p>
											<a href="indexnew.php?pid=<?php echo $row["ProductId"]; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo $row['Price'];   ?></h2>
												<p><?php  echo $row['ProductName'];  ?></p>
												<a href="indexnew.php?pid=<?php echo $row["ProductId"]; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
								 
								
						
					</div><!--features_items-->
					
					
					
					
				</div>
				
				<?php
								
								}
								
								?>
								
			</div>
		</div>
	</section>
	
	
	
	<?php
	
	include("LoginFooter.php");
	
	?>

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>