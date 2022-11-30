<?php 
	require "conn.php";
	session_start();

	//I realized that by putting the apostrophe, it returned 0 as a response because it took it as an escape
	$post_title = trim(mysqli_real_escape_string($conn, $_GET["title"]));

	if(isset($_GET["title"]) && isset($_GET["image"]) && $_GET["title"]!== ""){
		//I take info that the user write in the modal, and I load it in the db
		$mysql_qry = "INSERT INTO post (id_username,title,post_image) VALUES ('".$_SESSION["username"]."','".$post_title."','".$_GET["image"]."')";
		$result = mysqli_query($conn,$mysql_qry);
		
		if ($result) echo 1;
		else  echo 0;
	}

	else echo 0;

    
?>

