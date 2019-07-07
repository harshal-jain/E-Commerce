
<?php

include("connection.php");

if(isset($_REQUEST["btnContinue"]))
{
$Date= date("d M Y ");

$sql="INSERT INTO tbl_ordermaster (OMDate,UserId,DA_Name,DA_Phone,DA_Address,BA_Name,BA_Phone,BA_Address,Status) VALUES ('".$Date."','".$_SESSION["RegId"]."','".$_REQUEST["txt_NameS"]."','".$_REQUEST["txt_PhoneS"]."','".$_REQUEST["txt_AddressS"]."','".$_REQUEST["txt_NameB"]."','".$_REQUEST["txt_PhoneB"]."','".$_REQUEST["txt_AddressB"]."','0')       ";
		mysqli_query($con,$sql);
		
$sql="SELECT MAX(OMID) as OMID FROM tbl_ordermaster";
$tbl=mysqli_query($con,$sql);
if($tbl)
	if($row=mysqli_fetch_array($tbl))
		$OmId=$row["OMID"];



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
		$sql="INSERT INTO tbl_orderdetail (OMID, ProductId, Qty, Price) VALUES ($OmId,".$row["ProductId"].",".$row["Qty1"].",".$row["Price"].")";
		mysqli_query($con,$sql);
 		}
	}
	$Total=$net;
	$Tax=$Total*.12;
	$NetAmount=	$Total+$Tax;
	
	$sql="UPDATE tbl_ordermaster SET Total=".$Total.", Tax=".$Tax.", Net=".$NetAmount." WHERE OMID=".$OmId;
		mysqli_query($con,$sql);
		
		
		$sql="delete  FROM tbl_cart WHERE  UserId=".$_SESSION["RegId"] ;
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
    <title>Checkout | E-Shopper</title>
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
	
	
	include("IndexHeader.php");
	?>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							
							
							
						
							<form method="post" action="">
							
							<?php
							echo $_SESSION["RegId"];
	                         $sql="SELECT * FROM tbl_register WHERE id=".$_SESSION["RegId"];
							 echo $sql;
	                         $tbl=mysqli_query($con,$sql);
	                         if($tbl)
                             {
	                           if($row=mysqli_fetch_array($tbl))
	                             {
	
	                         ?>
		
								
								<input type="text" name="txt_NameS" value="<?php echo $row["Name"]; ?>">
								<input type="text" name="txt_EmailS" value="<?php echo $row["Email"]; ?>" >
								<input type="text" name="txt_PhoneS" placeholder="Phone">
								<input type="password" name="txt_PasswordS" value="<?php echo $row["Password"]; ?>" placeholder="Password">
								
								
														
	                          <?php
	
	                               }
	                          }
	
	
	                          ?>
			
			
			
							</form>
					
							<form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							
							<input type="submit" name="btnContinue" class="btn btn-primary" value="Continue" />
						
						    </form>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								
								
								
								
								<form>
								
								<?php
	                         $sql="SELECT * FROM tbl_register WHERE id=".$_SESSION["RegId"];
	                         $tbl=mysqli_query($con,$sql);
	                         if($tbl)
                             {
	                           if($row=mysqli_fetch_array($tbl))
	                             {
	
	                         ?>
									
									<input type="text" name="txt_EmailB" value="<?php echo $row["Email"]; ?>" >
									
								<input type="text" name="txt_NameB" value="<?php echo $row["Name"]; ?>">
								<input type="text" name="txt_PhoneB" placeholder="Phone">
									
									<input type="text" name="txt_AddressB" value="<?php echo $row["Address"]; ?>" placeholder="Address">
									
									      <?php
	
	                               }
	                          }
	
	
	                          ?>
			
									
								</form>
							
							
							
							
							</div>
							<div class="form-two">
								
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
									<a class="cart_quantity_up" href="checkout.php?pid=<?php echo $row["ProductId"]; ?>&id=add"> + </a>
									<input class="cart_quantity_input" type="text" name="txtQty<?php echo $row["ProductId"]; ?>" value="<?php echo $row["Qty1"]; ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="checkout.php?pid=<?php echo $row["ProductId"]; ?>&id=sub"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo $tot; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="checkout.php?did=<?php echo $row["CartId"]; ?>"><i class="fa fa-times"></i></a>
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
							
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td><?php echo $net; ?></td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td><?php  echo $Tax   ?></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span><?php  echo $NetAmount ?></span></td>
									</tr>
								</table>
							</td>
						</tr>
					
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

	<?php
	
	include("IndexFooter.php");
	
	?>


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>