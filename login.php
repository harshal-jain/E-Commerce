



<?php
include("connection.php");


//REGISTER:-

if(isset($_REQUEST["btnSubmit"]))
{ 
	$sql="SELECT * FROM tbl_register where Email='".$_REQUEST["txtEmail"]."'";
	$tbl=mysqli_query($con,$sql);
	if($tbl)
		if(mysqli_affected_rows($con)>0)
		{
			echo "Already Registered";
		}
		else
		{
		$sql="INSERT INTO tbl_register (Name,Email,Password) VALUES ('".$_REQUEST["txtName"]."','".$_REQUEST["txtEmail"]."','".$_REQUEST["txtPassword"]."')";
		mysqli_query($con,$sql);
			header("Location:login.php");
		}
}



//LOGIN:-


if(isset($_REQUEST["btnLogin"]))
{ 
	$sql="SELECT * FROM tbl_register where Email='".$_REQUEST["txtEmailL"]."' and Password='".$_REQUEST["txtPasswordL"]."'";
	echo $sql;
	$tbl=mysqli_query($con,$sql);
	if($tbl)
		if(mysqli_affected_rows($con)>0)
		{
			$row=mysqli_fetch_array($tbl);
			$_SESSION["RegId"]=$row["id"];	
			echo 		$_SESSION["RegId"];		
			//header("Location:index.php");
			//echo "";
		}
		else
		{
			echo "either phone no or password is wrong";
		}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
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
	
	include("LoginHeader.php")
	
	?>
	
	
	
	
	
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#">
							<input type="text" placeholder="Email Address" name="txtEmailL" />
							<input type="Password" placeholder="Password" name="txtPasswordL"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default" name="btnLogin">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#">
							<input type="text" placeholder="Name" name="txtName"/>
							<input type="text" placeholder="Email Address"  name="txtEmail" />
							<input type="Password" placeholder="Password"   name="txtPassword"/>
							<button type="submit" class="btn btn-default" name="btnSubmit">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php
	include("LoginFooter.php");
	
	
	?>
  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>