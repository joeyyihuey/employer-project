<?php

	require "connection.php";
	$res = array();
	$id = $_POST['id'];

	if(isset($_POST['product_name']) && isset($_POST['status'])  && isset($_POST['tax']) && isset($_POST['description']) && isset($_POST['price']))
	{
		$product_name = $_POST['product_name'];
		$status = $_POST['status'];
		$tax = $_POST['tax'];	
		$description = $_POST['description'];	
		$price = $_POST['price'];	


		if(!isset($_FILES['file_img']) || $_FILES['file_img']['error'] == UPLOAD_ERR_NO_FILE)
		{
		$sql = "UPDATE `products` SET `product_name`='$product_name',`status`='$status',`tax`='$tax',`description`='$description',`price`='$price' WHERE `id`='$id'";
		}
		else
		{
		$filetmp = $_FILES["file_img"]["tmp_name"];
		$filename = $_FILES["file_img"]["name"];
		$filetype = $_FILES["file_img"]["type"];
		$tmp   = explode('.', $filename);
		$extension = end($tmp);
		
		$new_file_name = $id.".".$extension;
		$filepath = "src/image/products/".$id.".".$extension;
		move_uploaded_file($filetmp,$filepath);
		
		
		$sql = "UPDATE `products` SET `product_name`='$product_name',`status`='$status',`tax`='$tax',`description`='$description',`price`='$price',`image_name`='$new_file_name' WHERE `id`='$id'";	
		}
		
		if (mysqli_query($conn, $sql)) {
			$res['status'] = 'success';
		    $res['msg']    = 'Update successful';
		} else {
		
			$res['status'] = 'error';
		    $res['msg']    = 'Update Failed';
		}

	}

	echo json_encode($res);	


?>