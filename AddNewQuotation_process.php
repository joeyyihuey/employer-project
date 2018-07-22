<?php
	session_start(); 
	require "connection.php";
	$res = array();

	if(!empty($_POST['date']) && !empty($_POST['expired_on']) && !empty($_POST['quotation_no']) && !empty($_POST['customer']) && !empty($_POST['amount']) && !empty($_POST['status'])  && !empty($_POST['company_id'])  && !empty($_POST['subheading'])  && !empty($_POST['footer']) && !empty($_POST['memo']) && !empty($_POST['P_O_S_O']) && !empty($_POST['subtotal']) && !empty($_POST['total']))
	{

			
			
			$date = $_POST['date'];	
			$expired_on = $_POST['expired_on'];
			$quotation_no = $_POST['quotation_no'];	
			$customer = $_POST['customer'];	
			$amount = $_POST['amount'];	
			$status = $_POST['status'];	
			$company_id = $_POST['company_id'];	


			$subheading = $_POST['subheading'];
			$footer = $_POST['footer'];	
			$memo = $_POST['memo'];	
			$P_O_S_O = $_POST['P_O_S_O'];	
			$subtotal = $_POST['subtotal'];	
			$total = $_POST['total'];	




		
			$sql = "INSERT INTO quotation(`date`,`expired_on`,`quotation_no`,`customer`,`amount`,`status`,`company_id`,`subheading`,`footer`,`memo`,`P_O_S_O`,`subtotal`,`total`)VALUES ('$date','$expired_on', '$quotation_no', '$customer', '$amount','$status','$company_id','$subheading','$footer', '$memo', '$P_O_S_O', '$subtotal','$total')";		
			mysqli_query($conn, $sql);

		
						
			$res['status'] = 'success';
    		$res['msg']    = 'New Quotation added';

			
	}else
	{
			$res['status'] = 'error';
	    	$res['msg']    = 'Quotation create failed,please fill in the require information';
	}		
			

echo json_encode($res);	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
		
?>