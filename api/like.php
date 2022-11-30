<?php 
	require "conn.php";

	session_start();

	$like_counter=0;

	if(isset($_GET["id_post"])){
		//I insert in the "like" tab the current logged user who liked a certain post
		$mysql_qry = "INSERT INTO likes VALUES ('".$_GET["id_post"]."','".$_SESSION["username"]."')";
		$result = mysqli_query($conn,$mysql_qry);
		//Query to count number of rows of likes that belong to that single post, so I get the number of likes of the post
		$mysql_qry2 = "SELECT id_post_like FROM likes WHERE id_post_like = '".$_GET['id_post']."'";
		$result2 = mysqli_query($conn, $mysql_qry2);
		$like_counter = mysqli_num_rows($result2);
		
		if ($result2) echo $like_counter;
		else echo 0;
	}

?>

