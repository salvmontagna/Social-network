<?php 
	require "conn.php";
	
	session_start();
	$like_counter=0;
	
	//This API works the same as like.php, it does the exact opposite

	if(isset($_GET["id_post"])){
		$mysql_qry = "SELECT * FROM likes WHERE id_post_like LIKE '".$_GET["id_post"]."' AND id_username_like LIKE '".$_SESSION["username"]."'";
		$result = mysqli_query($conn,$mysql_qry);
		
		if (mysqli_num_rows($result) > 0) {
			$mysql_qry2 = "DELETE FROM likes WHERE id_post_like LIKE '".$_GET["id_post"]."' AND id_username_like LIKE '".$_SESSION["username"]."'";
			mysqli_query($conn,$mysql_qry2);
			//Query per contare numero di righe dei like che appartengono a quel singolo post, così ho il numero di like del post tramite response
			$mysql_qry3 = "SELECT id_post_like FROM likes WHERE id_post_like = '".$_GET['id_post']."'";
			$result2 = mysqli_query($conn, $mysql_qry3);
			$like_counter = mysqli_num_rows($result2);
			echo $like_counter;
		}
		else echo 0;
	}

?>

