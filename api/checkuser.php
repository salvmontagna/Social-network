<?php 
	require "conn.php";

	if(isset($_GET["username"])){
		//Query that checks if the user passed in GET exists
		$mysql_qry = "SELECT * FROM user WHERE username LIKE '".$_GET["username"]."'";
		$result = mysqli_query($conn,$mysql_qry);
		
		if (mysqli_num_rows($result) > 0) {
			echo 1;
			$return_user=1;
		}
		else{
			echo 0;
			$return_user=0;
		}
	}
?>