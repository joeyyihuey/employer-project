<?php
	session_start(); 
	require "connection.php";	
	

	$role = $_POST['role'];


	if(!empty($_POST['email']) && !empty($_POST['pass']) )
	{
		$res = array();
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		if($role == "admin")
		{
			$sql = "SELECT * FROM `users` WHERE `email`='$email' && `pass`='$pass' ";
		}else
		{
			$sql = "SELECT * FROM `companies` WHERE `email`='$email' && `pass`='$pass' ";
		}
		


		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		

		if($row['email'] == $email && $row['pass'] == $pass)
		{		
			if($role == "admin")
			{
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$full_name = $first_name." ".$last_name;
				$_SESSION['full_name'] = $full_name;

			}else
			{
				$company_name = $row['company_name'];
				$_SESSION['company_name'] = $company_name;
			}

			$login_role = $row['role'];
			$id = $row['id'];
			$_SESSION['user_id'] = $id;
			
			$_SESSION['login_role'] = $login_role;
		

			
				$res['role'] = $login_role;
				$res['status'] = 'success';
		    	$res['msg']    = 'Login successfully.';
			

			
		}
		else
		{
			$res['status'] = 'error';
		    $res['msg']    = 'Login Failed.';
		}
	}
	else
	{
			$res['status'] = 'error';
		    $res['msg']    = 'No login data...';
	}	

	echo json_encode($res);	
	
?>