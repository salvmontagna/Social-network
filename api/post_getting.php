<?php

	require "conn.php";
   
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: ../login.php");
        exit;
	}

    //I select all the info I need to build a post on current logged user home
    //After the first select (which returns current logged user posts, I check which users he follow, so those posts are also shown)
	$query= "SELECT id_post, id_username, title, post_image, date_stamp, image, id_username_like 
				FROM post 
				JOIN user ON username = id_username 
				LEFT JOIN likes ON id_post = id_post_like AND id_username_like = '".$_SESSION['username']."'
				WHERE id_username LIKE '".$_SESSION['username']."' OR id_username 
				IN (SELECT username_following from follower where username like '".$_SESSION['username']."')
				ORDER BY date_stamp DESC";


    $res = mysqli_query($conn, $query);
    $like_counter = 0;
    $json = array();
    
    if (mysqli_num_rows($res) > 0){
        while ($row = mysqli_fetch_assoc($res)) {
        //I select the post in the "like" tab to count how many likes that single post has
            $query2 = "SELECT id_post_like FROM likes WHERE id_post_like = '".$row['id_post']."'";
            $res2 = mysqli_query($conn, $query2);
            $like_counter = mysqli_num_rows($res2);
            //I build the json with all the info needed for the post, which will be taken from js and printed dynamically
            $json[] = array('date_stamp' => $row['date_stamp'], 'id_post' => $row['id_post'], 'id_username' => $row['id_username'], 'image' => $row['image'], 'post_image' => $row['post_image'],  'title' => $row['title'], 'id_username_like' => $row['id_username_like'], 'like_counter' => $like_counter);

            }
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($json);
?>