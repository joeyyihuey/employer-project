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


		
	?>

	<?php if($user_id== NULL):?>

	<div class="alert alert-danger">
    	<h2><i class="fas fa-exclamation-triangle"></i> No Authority</a>.</h2>
  	</div>

  	<?php else: ?>



	<div class="container">
	<h1>Quotation</h1>
		<button type="button" class="btn btn-default">&nbsp <b>Filter</b> &nbsp</button>




		<div style="background-color: #e6e6e6;padding:10px;">
			<form class="form-horizontal" action="/action_page.php">
			    <div class="form-group">
				    <label class="control-label col-sm-2">Status:</label>
				    <div class="col-xs-4">
				        <input type="text" class="form-control"  placeholder="Filter by status" name="status">
				    </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-2">Customer:</label>
				      <div class="col-xs-4"> 
				      	<select class="form-control">
				      		<option>-- pick a customer --</option>
				      		
					    <?php while ($row = mysqli_fetch_array($result_users,MYSQLI_ASSOC)){   ?>
					    	<?php if($row['is_deleted'] == 0):?>

					    			<option><?php echo $row['first_name']?> <?php echo $row['last_name']?></option>

					    			    <?php endif; ?>
						<?php }?>

				      	</select>

				      
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-sm-2">Date:</label>
				      <div class="col-xs-4">          
				       <input type="date" class="form-control" id="email" placeholder="Enter email" name="email">
				      </div>
				    </div>
				 
				 
		  	</form>
		</div>



		<br/>     
		
		<table class="table table-striped">
		    <thead>
		    <tr>
		        <th>Status</th>
		        <th>Date</th>
		        <th>Quotation No</th>
		        <th>Customer</th>
		        <th>Amount</th>
		        
		    </tr>
		    </thead>

		    <tbody>

		    <?php while ($row=mysqli_fetch_assoc($result)){   ?>
		    	<?php if($row['is_deleted'] == 0):?>
			 	<tr>
			       
			       
			        <td><?php echo $row['status'] ?></td>
			        <td><?php echo $row['date'] ?></td>
			        <td><?php echo $row['quotation_no'] ?></td>
			        <td><?php echo $row['customer'] ?></td>
			        <td><?php echo $row['amount'] ?></td>
			     

			       	<td>
			       		<form action="delete_quotation_process.php" method="post" name="delete">
			       			<input type="hidden" name="id" value="<?php echo $row['id']?>">
			       			<button type="submit" class="btn btn-danger"
			       			<?php if($row['id'] == $user_id ):?>
				        	 	disabled
				        	<?php endif; ?>
			       			><i class="fas fa-trash-alt"></i> Delete</button>

			       		
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
	<a href="AddNewQuotation.php"><button type="button" class="btn btn-primary btn-md">
	    <span class="glyphicon glyphicon-upload"></span> Add Quotation
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



