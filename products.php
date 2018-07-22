<!DOCTYPE html>
<html lang="en">


<?php
	require "connection.php";	
 	require 'navbar.php'; 
?>
<body>

	<div hidden>
		<?php 
		$user_id = $_SESSION['user_id']; 
		$login_role = $_SESSION['login_role'];
		$company_name = $_SESSION['company_name'];
		?>
	</div>

	<?php
		
		$sql = "SELECT * FROM `products` where `company_id` = $user_id";
		
		$result = mysqli_query($conn,$sql);	
		
	?>

	<?php if($user_id== NULL):?>

	<div class="alert alert-danger">
    	<h2><i class="fas fa-exclamation-triangle"></i> No Authority</a>.</h2>
  	</div>

  	<?php else: ?>
	
	<div class="container">
		<center><h2>Products</h2></center>        
		
		<table class="table table-striped">
		    <thead>
		    <tr>
		        <th>ID</th>
		        <th>Products Picture</th>
		        <th>Name</th>
		        <th>Status</th>
		       
		        <th>Tax</th>
		     
		        <th>Price</th>
		           <th>Description</th>
		     
		    </tr>
		    </thead>

		    <tbody>

		    <?php while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){   ?>
		    	<?php if($row['is_deleted'] == 0):?>
			 	<tr>
			        <td><b><a href='product_detail.php?id=<?php echo $row['id'] ?>'><?php echo $row['id'] ?></a></b></td>
			        <td><img class="img-thumbnail" onerror="this.src = 'src/image/No_available_image.jpg'" src="src/image/products/<?php echo $row['image_name'] ?>"  width="100" height="100"></td>
			        	<td><?php echo $row['product_name'] ?></td>
			        	<td><?php echo $row['status'] ?></td>
			        	<td><?php echo $row['tax'] ?></td>
			            <td><?php echo $row['price'] ?></td>
			        	<td><?php echo $row['description'] ?></td>
			       	<td>
			       		<form action="delete_product_process.php" method="post" name="delete">
			       			<input type="hidden" name="id" value="<?php echo $row['id']?>">
			       			<button type="submit" class="btn btn-danger"
			       			<?php if($row['id'] == $user_id ):?>
				        	 	disabled
				        	<?php endif; ?>
			       			><i class="fas fa-trash-alt"></i> Delete</button><!-- only admin can delete,admin are not allow to delete themself,user delete will be disabled -->
			       		</form>
			       	</td>       		
			        
			    </tr>
			    <?php endif; ?>
			<?php }?>
		    </tbody>
		</table>
	</div>


	<?php endif; ?>

<?php if($user_id != NULL):?>

<div id="Add_product_btn">
<a href="AddNewProduct.php"><button type="button" class="btn btn-primary btn-md">
      <span class="glyphicon glyphicon-upload"></span> Add Product
</button></a>
</div>



<?php endif; ?>

</body>

<script>




$('[name="delete"]').submit(function(e)
{
    $.Event(e).preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'JSON',
    }).done(function(data)
    {
               
     	if (data.status == 'error')
        {
            new Noty({          
                type: data.status,
                text: data.msg,            
                timeout: 2000
            }).show();
        }
        else
        {
            new Noty({          
                type: data.status,
                text: data.msg,            
                timeout: 2000
            }).show();

            setTimeout(function()
            {
                location.reload();
            }, 1000);
        }      
       
    })
});

</script>


</html>



