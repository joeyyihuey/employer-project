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
	
		$sql = "SELECT * FROM `quotation` where `company_id` = $user_id";
		
		$result = mysqli_query($conn,$sql);	


		$sql_users = "SELECT * FROM `users` where `companies_id` = $user_id";
		
		$result_users = mysqli_query($conn,$sql_users);	


		$sql_products = "SELECT * FROM `products` where `company_id` = $user_id";
		
		$result_products = mysqli_query($conn,$sql_products);	
		
		$quotation_no = rand(10,10000);

		$quotation_no = "A".$quotation_no;

	?>

	<?php if($user_id== NULL):?>

	<div class="alert alert-danger">
    	<h2><i class="fas fa-exclamation-triangle"></i> No Authority</a>.</h2>
  	</div>

  	<?php else: ?>



	<div class="container">
	<h1>Quotation <?php echo $quotation_no;?></h1>
		
		<div style="background-color: #e6e6e6;padding:10px;">

				<form name="add_newQuotation" class="form-horizontal" method="post" action="AddNewQuotation_process.php">
				    <div class="form-group" >
					    <label class="control-label col-sm-2" for="email">Customer:</label>
					    <div class="col-xs-2">
					        <select class="form-control" name="customer">
					        <?php while ($row = mysqli_fetch_array($result_users,MYSQLI_ASSOC)){   ?>
					        	<option value="<?php echo $row['first_name']?> <?php echo $row['last_name']?>"><?php echo $row['first_name']?> <?php echo $row['last_name']?></option>
					        <?php }?>
					        </select>
					    </div>

					    <label class="control-label col-sm-2">Date:</label>
					    <div class="col-xs-2">
					        <input type="Date" class="form-control" name="date">
					    </div>

					    <label class="control-label col-sm-2">Subheading:</label>
					    <div class="col-xs-2">
					        <input type="text" class="form-control" name="subheading">
					    </div>
					</div>

					<div class="form-group" >
					    <label class="control-label col-sm-2">Currency:</label>
					    <div class="col-xs-2">
					        <input type="text" class="form-control" name="currency" value="MYR" readonly>
					    </div>

					    <label class="control-label col-sm-2">Expired On:</label>
					      <div class="col-xs-2">
					        <input type="Date" class="form-control"name="expired_on">
					    </div>

					     <label class="control-label col-sm-2">Footer</label>
					      <div class="col-xs-2">
					        <input type="text" class="form-control" name="footer">
					    </div>
					</div>


					<div class="form-group" >

					    <label class="control-label col-sm-2"></label>
					    <div class="col-xs-2">
					    </div>

					    <label class="control-label col-sm-2">P.O/S.O:</label>
					      <div class="col-xs-2">
					        <input type="number" class="form-control" name="P_O_S_O">
					    </div>

					     <label class="control-label col-sm-2" for="email">Memo:</label>
					      <div class="col-xs-2">
					        <input type="text" class="form-control" name="memo">
					    </div>
					</div>

						<br/>     
		
					<table class="table table-hover">
					    <thead>
						    <tr>
						        <th>Product</th>
						        <th>Description</th>
						        <th>Quantity</th>
						        <th>Price</th>
						        <th>Tax</th>
						        <th>Amount</th>
						    </tr>
					    </thead>

					    <tbody>
					    <tr>
					    	<td>
					    		<select class="form-control" name="product_name">
					    			<option>-- Choose --</option>
					    			<?php while ($row = mysqli_fetch_array($result_products,MYSQLI_ASSOC)){   ?>


							        	<option data-attribute='<?php echo json_encode($row) ?>' value='<?php echo $row['id'] ?>'>

							        		<?php echo $row['id']?> - <?php echo $row['product_name']?>
							      
							        	</option>
							        <?php }?>
					    		</select>
					    	</td>
					    	<td><input class="form-control" name="description"></td>
					    	<td><input class="form-control" name="quantity" value=0></td>
					    	<td><input class="form-control" name="price"></td>
					    	<td><input class="form-control" name="tax"></td>
					    	<td><input class="form-control" name="amount"></td>
					  	</tr>


					    <tr>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<td><label class="control-label col-sm-2">Subtotal:</label></td>
					    	<td><input class="form-control" name="subtotal"></td>
					  	</tr>


					  	<tr>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<td><label class="control-label">Total (MYR):</label></td>
					    	<td><input class="form-control" name="total"></td>
					  	</tr>
					    </tbody>
					</table>

					<input type="hidden" value="<?php echo $user_id ?>" name="company_id">
					  <input type="hidden" value="saved" name="status">
					  <input type="hidden" value="<?php echo $quotation_no ?>" name="quotation_no">
					<center><button type="submit" class="btn btn-primary">&nbsp <b>Save</b> &nbsp</button></center>
			  	</form>
		</div>	
	</div>
	<?php endif; ?>




</body>

<script>

	$('[name="product_name"]').on('change keyup', function() 
	{
		
		
		var product = $(this).children('option').filter(":selected").attr('data-attribute');
		product = JSON.parse(product);
			$('[name="description"]').val(product.description);
			// $('[name="quantity"]').val(product.quantity);
			$('[name="price"]').val(product.price);
			$('[name="tax"]').val(product.tax);

			var quantity = $('[name="quantity"]').val();
			var price = $('[name="price"]').val();
			var tax = $('[name="tax"]').val();
			var amount = parseFloat(price) * parseInt(quantity) + parseFloat(tax);
			$('[name="amount"]').val(amount.toFixed(2));
			$('[name="subtotal"]').val(amount.toFixed(2));
			$('[name="total"]').val(amount.toFixed(2));
			
	});


	 $('[name="add_newQuotation"]').submit(function(e)
    {
       
        $.Event(e).preventDefault();
        $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this), 
        contentType: false,       
        cache: false,           
        processData:false,  
        dataType: 'JSON',
        }).done(function(data)
        { 
            if (data.status != 'success')
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
                     window.location = "quotation.php";
                }, 1000);
            }    
        })
       
    });



</script>


</html>



