<?php
	session_start();
	session_destroy();
	clearstatcache();


	
	header( "refresh:0; url= index.php" );
?>