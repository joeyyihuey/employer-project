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
		$full_name = $_SESSION['full_name'];
		?>
	</div>

	<?php
		if($login_role == "admin")
		{
			$sql = "SELECT * FROM `companies`";
			$result = mysqli_query($conn,$sql);	
		}
		


		
		
	?>

	<?php if($user_id== NULL || $login_role != 'admin' ):?>

	<div class="alert alert-danger">
    	<h2><i class="fas fa-exclamation-triangle"></i> No Authority</a>.</h2>
  	</div>

  	<?php else: ?>
	
	<div class="container">
		<center><h2>Companies</h2></center>         
				
		<table class="table table-striped">
		    <thead>
		    <tr>
		        <th>ID</th>
		        <th>Logo</th>
		        <th>Company Name</th>
		        <th>Address</th>
		        <th>Email</th>
		        <th>Phone</th>
		        <th>Country</th>
		        <th>Contact Name</th>
		    </tr>
		    </thead>

		    <tbody>

		    <?php while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){   ?>
		    	<?php if($row['is_deleted'] == 0):?>
			 	<tr>
			        <td><b><a href='companies_detail.php?id=<?php echo $row['id'] ?>'><?php echo $row['id'] ?></a></b></td>
			        <td><img class="img-thumbnail" onerror="this.src = 'src/image/No_available_image.jpg'" src="src/image/companies/<?php echo $row['image_name'] ?>"  width="100" height="100"></td>
			        <td><?php echo $row['company_name'] ?></td>
			        <td><?php echo $row['address'] ?></td>
			        <td><?php echo $row['email'] ?></td>
			        <td><?php echo $row['phone_no'] ?></td>
			        <td><?php echo $row['country'] ?></td>
			        <td><?php echo $row['contact_name'] ?></td>

			       	<td>
			       		<form action="delete_company_process.php" method="post" name="delete">
			       			<input type="hidden" name="id" value="<?php echo $row['id']?>">
			       			<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
			       		</form>
			       	</td>       		
			        
			    </tr>
			    <?php endif; ?>
			<?php }?>
		    </tbody>
		</table>
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



