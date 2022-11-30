<?php

    require "api/conn.php";
    session_start();

?>
<html>
    <head>
        <title>Appleing</title>
        <meta charset="utf-8">
        <link rel="icon" href="images/favicon.png" type="image/png" />
        <link href="css/create_post.css" rel="stylesheet" >
        <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
        <script src='js/create_post.js' defer></script>
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
            <a  href="api/logout.php"><button id="button">Logout</button></a>
        </header>

        <main>
            <form id="form_all" name = "nome_form" method="post">
                <p id="search-side">  
                    <select id="service_list">
                        <option value="none">Choose a service</option>
                        <option value="giphy">Gifs</option>
                        <option value="pixabay">Images</option>
                    </select>
                    <label><input id="myInput" placeholder="Cerca l'immagine"  type="text" name="research" ></label>
                </p>
                    <label><input id="button" type='submit' name="cerca" value="Cerca"></label>
                
                </br>
                </br>
                <ul id="myUL">
                    <li id="under_section">
                        <!--
                        -- Prototype of users who will appear in the search with their own classes--
                        <a class="item_list">
                            <label><img class="img_list" src="images/user_img/ads123.jpg" width="50" height="50"></label>
                            <label class="name_list">Name</label>
                            <label class="user_list">(username)</label>
                            <label class="segui"> Follow</label>
                        </a>
                        -->
                    </li>
                </ul>

                    
            </form>
        </main>
        <div id="getting_username"><?php echo $_SESSION["username"];?> </div>
    </body>
</html>