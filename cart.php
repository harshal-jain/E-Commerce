<?php

include("connection.php");
if(!isset($_SESSION["RegId"]))
{
	header("Location:login.php");
}

if(isset($_REQUEST["did"]))
{
	$sql="DELETE FROM tbl_cart	 WHERE CartId=".$_REQUEST["did"];
	mysqli_query($con,$sql);
}

if(isset($_REQUEST["id"]) && $_REQUEST["id"]=='sub')
{
	$pid=$_REQUEST["pid"];
	$sql="UPDATE tbl_cart SET Qty=Qty-1  WHERE ProductId=".$pid;
	mysqli_query($con,$sql);
}

if(isset($_REQUEST["id"]) && $_REQUEST["id"]=='add')
{
	$pid=$_REQUEST["pid"];
	$sql="UPDATE tbl_cart SET Qty=Qty+1  WHERE ProductId=".$pid;
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
    <title>Cart | E-Shopper</title>
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
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						
						
						<?php
$sql="SELECT tbl_cart.Qty as Qty1, tbl_product.* FROM tbl_cart,tbl_product WHERE tbl_cart.ProductId=tbl_product.ProductId and UserId=".$_SESSION["RegId"] ;
$i=1;
$net=0;
$tot=0;
$tbl=mysqli_query($con,$sql);
if($tbl)
{
	while($row=mysqli_fetch_array($tbl))
	{
		$tot=$row["Price"]*$row["Qty1"];
		$net=$net+$tot;
?>  
						
						
						
						<tr>
							<td class="cart_product">
								<a href=""><img src="<?php echo $row["PhotoUrl"]; ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $row["ProductName"]; ?></a></h4>
								<p><?php echo $row["ProductId"]; ?> <input type="hidden" name="hdnProductId<?php echo $row["ProductId"]; ?>" value="<?php echo $row["ProductId"]; ?>" /></p>
							</td>
							<td class="cart_price">
								<p><?php echo $row["Price"]; ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="cart.php?pid=<?php echo $row["ProductId"]; ?>&id=add"> + </a>
									<input class="cart_quantity_input" type="text" name="txtQty<?php echo $row["ProductId"]; ?>" value="<?php echo $row["Qty1"]; ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="cart.php?pid=<?php echo $row["ProductId"]; ?>&id=sub"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo $tot; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="cart.php?did=<?php echo $row["CartId"]; ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						
						</tr>
						
						
						<?php
	}
}

?> 
		
		<?php
		
		$Total=$net;
	$Tax=$Total*.12;
	$NetAmount=	$Total+$Tax;
		
		
		?>				
						
						
						
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?php echo $net; ?></span></li>
							<li>Eco Tax <span><?php  echo $Tax   ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span><?php  echo $NetAmount ?></span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

<?php

include("LoginFooter.php");

?>


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>