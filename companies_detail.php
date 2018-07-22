<!DOCTYPE html>
<html lang="en">
<?php 
	require "connection.php";	
	require 'navbar.php'; 
?>


<?php 
	$id = $_GET['id'];
	$sql = "SELECT * FROM `companies` WHERE `id`=$id";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$company_name = $row['company_name'];
	$address = $row['address'];
	$email = $row['email'];
	$phone_no = $row['phone_no'];
	$image_name = $row['image_name'];
	$country = $row['country'];
	$contact_name = $row['contact_name'];
?>



<body>
<div class="container">
  		<h2>Edit Company</h2>
	  	<form name="update_company" class="form-horizontal" action="update_company_process.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-3">
					<img onerror="this.src = 'src/image/No_available_image.jpg'" src="src/image/companies/<?php echo $image_name?>" id='display_image' class="img-thumbnail" style="width:250px;height:250px">
				    <input type="file" accept='image/*' id="upload_image" name="file_img" onchange="openFile(this)"/>  
				</div>

				<div class="col-sm-9">
				    <div class="form-group">
					   <label>Company Name:</label>
					   <input type="text" class="form-control" id="first_name" value="<?php echo $row['company_name'] ?>" name="company_name">
				    </div>
					
				    <div class="form-group">
				      	<label>Address:</label>
				      	<input type="text" class="form-control" id="address" value="<?php echo $row['address'] ?>" name="address">
				    </div>

				    <div class="form-group">
				      	<label>Email:</label>
				      	<input type="text" class="form-control" id="email" value="<?php echo $row['email'] ?>" name="email"/>
				    </div>

				    <div class="form-group">
				      	<label>Country:</label>
				      	<input type="text" class="form-control" id="country" value="<?php echo $row['country'] ?>" name="country"/>	  
				    </div>

				    <div class="form-group">
				      	<label>Contact Name:</label>
				      	<input type="text" class="form-control" id="contact_name" value="<?php echo $row['contact_name'] ?>" name="contact_name"/>	  
				    </div>

				    <div class="form-group">
				      	<label>Phone No:</label>
				      	<input type="text" class="form-control" id="phone_no" value="<?php echo $row['phone_no'] ?>" name="phone_no"/>
				    </div>

				    <div class="form-group">
		  			<input type="hidden" name="id" value="<?php echo $id ?>">
		  			<button id="update_btn" type="submit" class="btn btn-success" name="update_btn">Update</button>
		 			<a href="companies.php" class="btn btn-danger" role="button">Back</a>
					</div> 

			    </div>
		    </div>
	    </form>
 </div>
   
   <script>
   	
    $('[name="update_company"]').submit(function(e)
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
                     window.location = "companies.php";
                }, 1000);
            }    
        })
       
    });




   </script>


</body>

</html>