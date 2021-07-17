<?php

require 'dbconfig/config.php';
	@$pid="";
	@$pname="";
	$pbrand="";
	@$pcost="";
	@$pquantity="";
?>
<!DOCTYPE html>
<html>
<head>
<title>Product Inventory</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#000000">
	<div id="main-wrapper">
		<center><h2>MINI INVENTORY MANAGEMENT SYSTEM</h2></center>
		
		
		<div class="inner_container">
		
			<?php
				if(isset($_POST['fetch_btn'])){
					 					
					$pid = $_POST['pid'];
					
					if($pid=="")
					{
						echo '<script>alert("Enter PID to get prodcut details")</script>';
					}
					else
					{
						$query = "select * from products where pid=$pid";
						$query_run = mysqli_query($con,$query);
						if($query_run)
						{
							if(mysqli_num_rows($query_run)>0)
							{
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
								@$pid=$row['id'];
								@$pname=$row['pname'];
								@$pbrand=$row['pbrand'];
								@$pcost=$row['pcost'];
								@$pquantity=$row['pquantity'];
							}
							else{
								echo '<script>alert("Invalid PID")</script>';
							}
						}
						else{
							echo '<script>alert("Error in query")</script>';
						}
						
					}
					
				}
			?>
			
			<form action="index.php" method="post">
			
				<label><b>Product ID</b>  </label><button id="btn_go" name="fetch_btn" type="submit">Go</button>
				
				<input type="text" placeholder="Enter Product ID" name="pid" value="<?php echo @$_POST['pid'];?>" >
				<label><b>Product Name</b></label>
				<input type="text" placeholder="Enter Product Name" name="pname" value="<?php echo $pname; ?>">
				<label><b>Product Brand</b></label>
				<input type="text" placeholder="Enter Product Brand" name="pbrand" value="<?php echo $pbrand; ?>">
				<label><b>Product Cost</b></label>
				<input type="number" placeholder="Enter Product Cost" name="pcost"value="<?php echo $pcost; ?>" >
				<label><b>Product Quantity</b></label><br>
				<input type="number" placeholder="Enter Product Quantity" name="pquantity" value="<?php echo $pquantity; ?>">
				
				<center>
					<button id="btn_insert" name="insert_btn" type="submit">Insert</button>
					<button id="btn_update" name="update_btn" type="submit">Update</button>
					<button id="btn_delete" name="delete_btn" type="submit">Delete</button>
				</center>
			</form>
			
			<?php
			
				if(isset($_POST['insert_btn'])){
										
					@$pid=$_POST['pid'];
					@$pname=$_POST['pname'];
					@$pbrand=$_POST['pbrand'];
					@$pcost=$_POST['pcost'];
					@$pquantity=$_POST['pquantity'];
					
					if($pid=="" || $pname=="" || $pbrand=="" || $pcost=="" || $pquantity=="")
					{
						echo '<script> alert("Insert values in all fields") </script>';
					}
					else{
						$query = "insert into products values($pid,'$pname','$pbrand',$pcost,$pquantity)";
						$query_run=mysqli_query($con,$query);
						if($query_run)
						{
								echo '<script>alert("Values inserted successfully")</script>';
						}
						else{
							echo '<script> alert("Values Not inserted") </script>';
						}
					}
					
				}
				
				else if(isset($_POST['update_btn']))
				{
					if($_POST['pid']=="" || $_POST['pname']=="" || $_POST['pbrand']=="" || $_POST['pcost']=="" || $_POST['pquantity']=="")
					{
						echo '<script>alert("Enter Data in All fields")</script>';
					}
					else
					{
						@$pid=$_POST['pid'];
						@$pname=$_POST['pname'];
						@$pbrand=$_POST['pbrand'];
						@$pcost=$_POST['pcost'];
						@$pquantity=$_POST['pquantity'];
						
						$query = "update products 
							SET pname='$pname',pbrand='$pbrand',pcost=$pcost,pquantity=$pquantity 
							WHERE pid=$pid";
							
						$query_run = mysqli_query($con,$query);
				
							if($query_run)
							{
								echo '<script>alert("Product Updated successfully")</script>';
							}
							else{
								echo '<script>alert("Error")</script>';
							}
						
					}
				}
				
				else if(isset($_POST['delete_btn']))
				{
					if($_POST['pid']=="")
					{
						echo '<script>alert("Enter PID to delete product")</script>';
					}
				else{
						$pid = $_POST['pid'];
						$query = "delete from products 
							WHERE pid=$pid";
						$query_run = mysqli_query($con,$query);
						if($query_run)
						{
							echo '<script>alert("Product deleted")</script>';
						}
						else
						{
							echo '<script>alert("Error in query")</script>';
						}
					}
				
				
				}
			
			?>
		</div>
	</div>
</body>
</html>