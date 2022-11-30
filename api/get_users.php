<?php 
	require "conn.php";
    
	session_start();

	if(isset($_GET["id_post"])){
		//I select the usernames and join with user to obtain their profile picture (only aesthetic matter)
		$mysql_qry = "SELECT id_username_like,image
		FROM likes l, user u
		WHERE l.id_username_like=u.username AND id_post_like LIKE '".$_GET["id_post"]."'";
		$result = mysqli_query($conn,$mysql_qry);
			
		$json = array();

		//If the select is successful, I build a json, with the user's username and image who put like to a certain post
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$json[] = array('id_username_like' => $row['id_username_like'],'image' => $row['image']);
			}
		}
		else echo 0;
	}

	mysqli_free_result($result);
	mysqli_close($conn);
	echo json_encode($json);
	
?>

