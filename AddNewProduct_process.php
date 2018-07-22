<?php
	session_start(); 
	require "connection.php";
	$res = array();

	if(!empty($_POST['product_name']) && !empty($_POST['status']) && !empty($_POST['tax']) && !empty($_POST['description']) && !empty($_POST['price']))
	{

			$product_name = $_POST['product_name'];
			
			$status = $_POST['status'];	
			
			$tax = $_POST['tax'];	
			$description = $_POST['description'];	
			$price = $_POST['price'];	
			$company_id = $_POST['company_id'];	
		
			$sql = "INSERT INTO products(`product_name`,`status`,`tax`,`description`,`price`,`company_id`)VALUES ('$product_name','$status', '$tax', '$description','$price','$company_id')";		
			mysqli_query($conn, $sql);

			$last_id = mysqli_insert_id($conn);
			$filetmp = $_FILES["file_img"]["tmp_name"];
			$filename = $_FILES["file_img"]["name"];
			$filetype = $_FILES["file_img"]["type"];
			$tmp   = explode('.', $filename);
			$extension = end($tmp);

			$new_file_name = $last_id.".".$extension;
			$filepath = "src/image/products/".$last_id.".".$extension;
			move_uploaded_file($filetmp,$filepath);
			
			$sql = "UPDATE `products` SET `image_name`='$new_file_name' WHERE `id`='$last_id'";	
			mysqli_query($conn, $sql);
						
			$res['status'] = 'success';
    		$res['msg']    = 'New product added';

			
	}else
	{
			$res['status'] = 'error';
	    	$res['msg']    = 'Product create failed,please fill in the require information';
	}		
			

echo json_encode($res);	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
		
?>