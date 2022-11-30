<?php 
	require "conn.php";
	
	//Used a trick because I didn't remember having the session that I could use
	//So I passed the username to get (at the moment I'm leaving it like this for timing reasons)
	if(isset($_GET["username"]) && isset($_GET["username_following"])){

		session_start();
		//I verify that the clicked user actually exists
        $mysql_qry = "SELECT * FROM follower WHERE username LIKE '".$_GET["username"]."' AND username_following LIKE '".$_GET["username_following"]."'";
		$result = mysqli_query($conn,$mysql_qry);
		
		if (mysqli_num_rows($result) > 0) {
			//After the check, I remove from the "follower" tab the user who is no longer followed 
            $mysql_qry2 = "DELETE FROM follower WHERE username LIKE '".$_GET["username"]."' AND username_following LIKE '".$_GET["username_following"]."'";
            mysqli_query($conn,$mysql_qry2);
            echo 1;
		}
		else echo 0;
	}
?>

