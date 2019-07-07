<?php

include("connection.php");


if(isset($_REQUEST["did"]))
{
	$sql="DELETE FROM tbl_product	 WHERE ProductId=".$_REQUEST["did"];
	mysqli_query($con,$sql);
}

if(isset($_REQUEST["btn_Submit"]))
{
	
	
	$sql="SELECT MAX(ProductId) as Id FROM tbl_product ";
    $tbl=mysqli_query($con,$sql);
	
	if($row=mysqli_fetch_array($tbl))
	{
		$id= $row["Id"];
		
		$fn=$_FILES["fu_Photo"]["name"];
		$spath=$_FILES["fu_Photo"]["tmp_name"];
		
		$ext=pathinfo($fn, PATHINFO_EXTENSION);
		//echo $ext;
		
		if($ext== 'jpg' ||$ext== 'gif' ||$ext== 'dmg' || $ext== 'jfif')
		{
		$dpath="uploadproductpic/".$id.".".$ext; 
		//echo $dpath;
		move_uploaded_file($spath,$dpath);
		
		$sql="INSERT INTO tbl_product (ProductName,Price,Qty,PhotoUrl,Description,CategoryId) VALUES ('".$_REQUEST["txt_ProductName"]."','".$_REQUEST["txt_Price"]."','".$_REQUEST["txt_Qty"]."','".$dpath."','".$_REQUEST["txt_Description"]."','".$_REQUEST["ddl_CategoryAdd"]."')";
    mysqli_query($con,$sql);
	}
	else
	echo "Format is wrong";
		
	}
}

if(isset($_REQUEST["btn_SubmitE"]))
{
	$sql="UPDATE tbl_product SET ProductName='".$_REQUEST["txt_ProductNameE"]."',Price='".$_REQUEST["txt_PriceE"]."',Price='".$_REQUEST["txt_QtyE"]."',Description='".$_REQUEST["txt_DescriptionE"]."' where ProductId=".$_REQUEST["eid"];
    mysqli_query($con,$sql);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Cloud Admin | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="css/cloud-admin.css" >
	<link rel="stylesheet" type="text/css"  href="css/themes/default.css" id="skin-switcher" >
	<link rel="stylesheet" type="text/css"  href="css/responsive.css" >
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- ANIMATE -->
	<link rel="stylesheet" type="text/css" href="css/animatecss/animate.min.css" />
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- TODO -->
	<link rel="stylesheet" type="text/css" href="js/jquery-todo/css/styles.css" />
	<!-- FULL CALENDAR -->
	<link rel="stylesheet" type="text/css" href="js/fullcalendar/fullcalendar.min.css" />
	<!-- GRITTER -->
	<link rel="stylesheet" type="text/css" href="js/gritter/css/jquery.gritter.css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- HEADER -->
	<?php
	include("header.php");
	
	?>
	<!--/HEADER -->
	
	<!-- PAGE -->
	<section id="page">
				<?php
				include("sidebar.php");
				
				?>
				<!-- /SIDEBAR -->
		<div id="main-content">
			<!-- SAMPLE BOX CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h4 class="modal-title">Box Settings</h4>
					</div>
					<div class="modal-body">
					  Here goes box setting content.
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  <button type="button" class="btn btn-primary">Save changes</button>
					</div>
				  </div>
				</div>
			  </div>
			<!-- /SAMPLE BOX CONFIGURATION MODAL FORM-->
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<!-- STYLER -->
									
									<!-- /STYLER -->
									<!-- BREADCRUMBS -->
									<ul class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a href="index.php">Home</a>
										</li>
										<li>Products</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Products</h3>
										<!-- DATE RANGE PICKER -->
										<span class="date-range pull-right">
											<div class="btn-group">
												<a class="js_update btn btn-default" href="#">Today</a>
												<a class="js_update btn btn-default" href="#">Last 7 Days</a>
												<a class="js_update btn btn-default hidden-xs" href="#">Last month</a>
												
												<a id="reportrange" class="btn reportrange">
													<i class="fa fa-calendar"></i>
													<span></span>
													<i class="fa fa-angle-down"></i>
												</a>
											</div>
										</span>
										<!-- /DATE RANGE PICKER -->
									</div>
									<div class="description">Overview, Statistics and more</div>
								</div>
							</div>
						</div>
						
						<!-- /PAGE HEADER -->
						<div class="col-md-6">
								<!-- BOX -->
								<div class="box border pink">
									<div class="box-title">
										<h4><i class="fa fa-table"></i>Products</h4>
										<div class="tools">
											<a href="#box-config" data-toggle="modal" class="config">
												<i class="fa fa-cog"></i>
											</a>
											<a href="javascript:;" class="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="javascript:;" class="collapse">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a href="javascript:;" class="remove">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="box-body">
										
<form method="post" action="" enctype="multipart/form-data">
<table width="100%" border="1">
  
  <?php 
	if(!isset($_REQUEST["id"]) || (isset($_REQUEST["id"]) && $_REQUEST["id"]=="1"))
	{  
  ?>
  <tr>
    <td>
	
	
	<table width="100%" border="1">
	<thead>
	<tr>
    <td colspan="8"><a href="products.php?id=2">Add</a></td>
	
  </tr>
  
  <tr>
    <th>Product Id</th>
    <th>Product Name</th>
    <th>Price</th>
	<th>Qty</th>
	<th>PhotoURL</th>
    <th>Description</th>
	
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </thead>
<?php
$sql="SELECT * FROM tbl_product";
$i=1;
$tbl=mysqli_query($con,$sql);
if($tbl)
{
	while($row=mysqli_fetch_array($tbl))
	{
?>  
<tbody>
  <tr>
    
    <td><?php echo $row["ProductId"]; ?></td>
    <td><?php echo $row["ProductName"]; ?></td>
	<td><?php echo $row["Price"]; ?></td>
	<td><?php echo $row["Qty"]; ?></td>
    <td><img src="<?php echo $row["PhotoUrl"]; ?>"  width="100px"/></td>
	<td><?php echo $row["Description"]; ?></td>
	
    
    <td><a href="products.php?did=<?php echo $row["ProductId"]; ?>">Delete</a></td>
    <td><a href="products.php?id=3&eid=<?php echo $row["ProductId"]; ?>">Edit</a></td>
  </tr>
  </tbody>
<?php
	}
}

?>  
  
  
</table>
	
	
	</td>
  </tr>
  <?php
  }
  ?>
  
	<?php 
	if( isset($_REQUEST["id"]) && $_REQUEST["id"]=="2")
	{  
  ?>
  <tr>
    <td><table width="300" border="1">
      <tr>
        <td colspan="2"><a href="products.php?id=1">Back</a></td>
        
      </tr>
	  <tr>
	     <th>Category Name </th>
		 
		 <?php
		 $sql= "SELECT * FROM tbl_category";
		 $result= mysqli_query($con,$sql);
		 ?>
		 
		 <td>
		 <select name="ddl_CategoryAdd">
		 
		 <?php
		 
		 while($row=mysqli_fetch_array($result))
		 {
		 ?>
		 <option value="<?php echo $row['CategoryId']; ?>"><?php echo $row['CategoryName'];  ?> </option>   
		 
		 <?php
		 }
		 ?>
		 </select>
		 </td>
	  </tr>
   
   <tr>
    <th>Product Name</th>
    <td><input type="text" name="txt_ProductName" /> </td>
  </tr>
   <tr>
    <th>Price</th>
    <td><input type="text" name="txt_Price" /> </td>
  </tr>
   <tr>
    <th>Qty</th>
    <td><input type="text" name="txt_Qty" /> </td>
  </tr>
    <tr>
    <th>Photo Url</th>
    <td><input type="file" name="fu_Photo" /> </td>
  </tr>
   <tr>
    <th>Description</th>
    <td><input type="text" name="txt_Description" /> </td>
  </tr>
   
    <th>&nbsp;</th>
    <td><input type="submit" name="btn_Submit" value="Submit" /></td>
  </tr>
    </table></td>
  </tr>
  
    <?php
  }
  ?>

  	<?php 
	if( isset($_REQUEST["id"]) && $_REQUEST["id"]=="3")
	{  
	$sql="SELECT * FROM tbl_product where ProductId=".$_REQUEST["eid"];
$tbl=mysqli_query($con,$sql);
if($tbl)
{
	if($row=mysqli_fetch_array($tbl))
	{
  ?>
  <tr>
    <td><table width="300" border="1">
      <tr>
        <td colspan="2"><a href="products.php?id=1">Back</a></td>
      </tr>
  
  <tr>
    <th>Product Name</th>
    <td><input type="text" name="txt_ProductNameE" value="<?php echo $row["ProductName"]; ?>" /> </td>
  </tr>
  <tr>
    <th>Price</th>
    <td><input type="text" name="txt_PriceE" value="<?php echo $row["Price"]; ?>" /> </td>
  </tr>
  <tr>
    <th>Qty</th>
    <td><input type="text" name="txt_QtyE" value="<?php echo $row["Qty"]; ?>" /> </td>
  </tr>
    <tr>
    <th>PhotoUrl</th>
    <td><input type="file" name="fu_PhotoE" value="<?php echo $row["Photo"]; ?>"  /> </td>
  </tr>
    <tr>
    <th>Description</th>
    <td><input type="text" name="txt_DescriptionE" value="<?php echo $row["Description"]; ?>" /> </td>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" name="btn_SubmitE" value="Submit" /></td>
  </tr>
    </table></td>
  </tr>
  
    <?php
  }}}
  ?>
</table>
</form>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						<!-- DASHBOARD CONTENT -->
						
					   <!-- /DASHBOARD CONTENT -->
					   <!-- HERO GRAPH -->
						
						<!-- /HERO GRAPH -->
						<!-- NEW ORDERS & STATISTICS -->
						<div class="row">
							<!-- NEW ORDERS -->
							
							<!-- /NEW ORDERS -->
							<!-- STATISTICS -->
							
							<!-- /STATISTICS -->
							
						<!-- /NEW ORDERS & STATISTICS -->
						<!-- CALENDAR & CHAT -->
						<div class="row">
							<!-- CALENDAR -->
							
							<!-- /CALENDAR -->
							<!-- CHAT -->
							
							<!-- CHAT -->
						</div>
						<!-- /CALENDAR & CHAT -->
						
					</div><!-- /CONTENT-->
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="bootstrap-dist/js/bootstrap.min.js"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="js/bootstrap-daterangepicker/moment.min.js"></script>
	
	<script src="js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script><script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="js/jQuery-BlockUI/jquery.blockUI.min.js"></script>
	<!-- SPARKLINES -->
	<script type="text/javascript" src="js/sparklines/jquery.sparkline.min.js"></script>
	<!-- EASY PIE CHART -->
	<script src="js/jquery-easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/easypiechart/jquery.easypiechart.min.js"></script>
	<!-- FLOT CHARTS -->
	<script src="js/flot/jquery.flot.min.js"></script>
	<script src="js/flot/jquery.flot.time.min.js"></script>
    <script src="js/flot/jquery.flot.selection.min.js"></script>
	<script src="js/flot/jquery.flot.resize.min.js"></script>
    <script src="js/flot/jquery.flot.pie.min.js"></script>
    <script src="js/flot/jquery.flot.stack.min.js"></script>
    <script src="js/flot/jquery.flot.crosshair.min.js"></script>
	<!-- TODO -->
	<script type="text/javascript" src="js/jquery-todo/js/paddystodolist.js"></script>
	<!-- TIMEAGO -->
	<script type="text/javascript" src="js/timeago/jquery.timeago.min.js"></script>
	<!-- FULL CALENDAR -->
	<script type="text/javascript" src="js/fullcalendar/fullcalendar.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<!-- GRITTER -->
	<script type="text/javascript" src="js/gritter/js/jquery.gritter.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="js/script.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("index");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->
</body>
</html>