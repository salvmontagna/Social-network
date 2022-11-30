<?php 
	require "conn.php";

	if(isset($_GET["username"]) && isset($_GET["username_following"])){
		//Query to insert the user who has just been followed in the "follower" tab of current logged user
		$mysql_qry = "INSERT INTO follower VALUES ('".$_GET["username"]."','".$_GET["username_following"]."')";
		$result = mysqli_query($conn,$mysql_qry);
		
		if ($result) echo 1;
		else echo 0;
		
	}
    
?>

