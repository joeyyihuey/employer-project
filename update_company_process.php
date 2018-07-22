<?php

	require "connection.php";
	$res = array();
	$id = $_POST['id'];

	if(isset($_POST['company_name']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['phone_no']) && isset($_POST['country']) && isset($_POST['contact_name']))
	{
		$company_name = $_POST['company_name'];
	
		$address = $_POST['address'];	
		$email = $_POST['email'];	
		$phone_no = $_POST['phone_no'];	
		$country = $_POST['country'];	
		$contact_name = $_POST['contact_name'];	
		

		if(!isset($_FILES['file_img']) || $_FILES['file_img']['error'] == UPLOAD_ERR_NO_FILE)
		{
		$sql = "UPDATE `companies` SET `company_name`='$company_name',`address`='$address',`email`='$email',`phone_no`='$phone_no',`country`='$country',`contact_name`='$contact_name' WHERE `id`='$id'";
		}
		else
		{
		$filetmp = $_FILES["file_img"]["tmp_name"];
		$filename = $_FILES["file_img"]["name"];
		$filetype = $_FILES["file_img"]["type"];
		$tmp   = explode('.', $filename);
		$extension = end($tmp);
		
		$new_file_name = $id.".".$extension;
		$filepath = "src/image/companies/".$id.".".$extension;
		move_uploaded_file($filetmp,$filepath);
		
		
		$sql = "UPDATE `companies` SET `company_name`='$company_name',`address`='$address',`email`='$email',`phone_no`='$phone_no',`country`='$country',`contact_name`='$contact_name',`image_name`='$new_file_name' WHERE `id`='$id'";	
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