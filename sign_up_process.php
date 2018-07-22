<?php
	session_start(); 
	require "connection.php";
	$res = array();

	if(!empty($_POST['company_name']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['phone_no']) && !empty($_POST['country'])&& !empty($_POST['contact_name'])  && !empty($_POST['pass']))
	{


		$sql_check_empty = "SELECT * FROM companies";
		$query_run_email = mysqli_query($conn,$sql_check_empty);
		$num_rows = mysqli_num_rows($query_run_email);

		

			$company_name = $_POST['company_name'];
			$address = $_POST['address'];	
			$email = $_POST['email'];	
			$phone_no = $_POST['phone_no'];
		
			$country = $_POST['country'];	
			$contact_name = $_POST['contact_name'];	
			$pass = $_POST['pass'];	
			
			$query_email = "SELECT `email` FROM `companies` WHERE `email`='$email'";


			$query_email_users = "SELECT `email` FROM `users` WHERE `email`='$email'";


			$query_run_email = mysqli_query($conn,$query_email);
			$query_run_user = mysqli_query($conn,$query_email_users);

			if(!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
			{
				if (mysqli_num_rows($query_run_email))
				{
					$res['status'] = 'error';
		    		$res['msg']    = 'Email already exists.';

				}else if (mysqli_num_rows($query_run_user)) 
				{
					$res['status'] = 'error';
		    		$res['msg']    = 'Email already exists.';
				}
				else
				{
					$sql = "INSERT INTO companies(`company_name`, `address`,`email`,`phone_no`,`country`,`contact_name`,`pass`)VALUES ('$company_name', '$address','$email', '$phone_no', '$country', '$contact_name', '$pass')";		
					mysqli_query($conn, $sql);
					
					$res['status'] = 'success';
		    		$res['msg']    = 'Account created successful';
				}
			}else
			{			

				$res['status'] = 'error';
		    	$res['msg']    = 'email format wrong,example : test@example.c';
			
			}
	}else
	{
				$res['status'] = 'error';
		    	$res['msg']    = 'account created failed,please fill in the require information';
	}		
			

echo json_encode($res);	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
		
?>