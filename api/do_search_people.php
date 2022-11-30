<?php 

    require "conn.php";

    //Start the session to pass the username
    session_start();
    if(isset($_GET["username"]) && isset($_GET["name"]) && isset($_GET["surname"])){
        //Query for the select of the info of the username sought
        //I use "LIKE" operator as a search filter, to search for people who begin with the written string
        $query = "SELECT name, surname, username, image FROM user WHERE username LIKE '%".$_GET['username']."%' OR name LIKE '%".$_GET['name']."%' OR surname LIKE '%".$_GET['surname']."%'";
        $res = mysqli_query($conn, $query);
        //I initialize the json as an array, to encapsulate the user info
        $json = array();   
        if (mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                //I check through a query, if logged user follow the user that is in the json
                //If searched user is followed, I build a json inserting a "follow=1" field
                //If searched user is not followed, follow value is 0.
                //Later these boolean values, will be checked by js to show follow and unfollow
                $query2 = "SELECT * FROM follower WHERE username_following LIKE '".$row['username']."' AND username LIKE '".$_SESSION['username']."'";
                $res2 = mysqli_query($conn, $query2);
                if (mysqli_num_rows($res2) > 0)
                    $json[] = array('username' => $row['username'], 'name' => $row['name'], 'surname' => $row['surname'], 'image' => $row['image'], 'follow' => '1');
                    
                else
                    $json[] = array('username' => $row['username'], 'name' => $row['name'], 'surname' => $row['surname'], 'image' => $row['image'], 'follow' => '0');
            }
        }
    }
    
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($json);

?>