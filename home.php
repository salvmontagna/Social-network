<?php

    require "api/conn.php";
    $image=NULL;

    session_start();
    //Check if user is logged
    if(!isset($_SESSION['username']))
    {
        //Go to login if not
        header("Location: login.php");
        exit;
    }

    //Get profile image
    $query = "SELECT image FROM user WHERE username LIKE '".$_SESSION['username']."'";
    $res = mysqli_query($conn, $query);
    if($res->num_rows>0 ){
        while ($row = $res->fetch_assoc()) {
            $image = $row["image"];
        }
    }
?>

<html>
    <head>
        <title>Social network</title>
        <meta charset="utf-8">
        <link rel="icon" href="images/favicon.png" type="image/png" />
        <script src='js/home.js' defer></script>
        <link href="css/home.css" rel="stylesheet" >
        <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Source Sans Pro' rel='stylesheet'>
    </head>
    <body>
        <header>
            <img class="logo" src="images/logomini.svg" alt="logo"> 
            <nav>
                <ul class="nav_link">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="create_post.php">New post</a></li>
                    <li><a class="search" href="search.php">Users research</a></li>
                </ul>  
            </nav>
            <a  href="api/logout.php"><button>Logout</button></a>
        </header>
        
        <div id="username">
            <img id ="avatar" name="photo" <?php echo '<img src="'.'./images/user_img/'.$image.'">' ?>
            <span id="name"><?php echo $_SESSION["username"];?></span>
            <div id="time">  
                <span>Last access: <?php  echo $date = date('H:i ', time());?></span>
                <span></span>
                <span id="line"></span>
            </div>   
        </div>
        <!--  Container of all items !-->
        <div class="section">
            <!--  Cycled items
            <div class="mini_container">
                <img class="user_img" src="images/user_img/ciadso12.jpg">
                <div class="item">
                <div class="user_nick">test1 ( Posted: <?php  echo $date = date('d/m/Y', time());?>) </div>
                    <div class= "post_title">Nice dog</div>
                    <img src="https://media1.giphy.com/media/ppLnsUYynW0ne/100.gif?cid=35a20dad39c673955844c05656ca1fac962c50f54dfea124">  
                    
                    <div class="likes_section">
                        <p class="like_button"> </p>
                        <p class="like_counter">2</p>
                    </div>
                </div>
            </div>    
            !-->  
        </div>
        <div id="getting_username"><?php echo $_SESSION["username"];?> </div>
    </body>
</html>