
<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">
									
									<?php
									
									$sql="SELECT * FROM tbl_Category WHERE Status=0";
									
									$tbl=mysqli_query($con,$sql);
                                    if($tbl)
                                       {
	                                      while($row=mysqli_fetch_array($tbl))
	                                         { 
									
									?>
									
									
									<a href="indexnew.php?aid=<?php echo $row['CategoryId'];    ?>"  >
									
									<?php echo $row["CategoryName"]; ?>
									
									</a>
									 <?php     echo"<br><br>" ?>
									
									<?php
									
									}}
									?>
									
									
									</a>
									</h4>
								</div>
							</div>
							
						</div><!--/category-products-->