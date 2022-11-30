<?php
    
    require "api/conn.php";
   
    session_start();

    //Check is user is logged and take him to homepage
    if(isset($_SESSION["username"]))
    {
        header("Location: ./home.php");
        exit;
    }

    //Check if any post exists
    if(isset($_POST["username"]) && isset($_POST["password"])){
        //trim: remove any spaces at the beginning and end of the string
        //mysqli_real_escape: escape special characters, to avoid sql injection
        $username = trim(mysqli_real_escape_string($conn, $_POST["username"]));
        $user_passw = trim(mysqli_real_escape_string($conn, $_POST["password"]));
      
        $query = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$user_passw."'";
        $res = mysqli_query($conn, $query);
        //Check the correctness of the credentials
        if(mysqli_num_rows($res) > 0){
            //Set session variable
            $_SESSION["username"] = $_POST["username"];
            header("Location: home.php");
            exit;
        }
        else{
            //Error flag
            $errore = true;
        }
    }

?>
<html>
    <head>
        <link rel="icon" href="images/favicon.png" type="image/png" />
        <link rel='stylesheet' href='css/login.css'>
        <script src='js/login.js' defer></script>
        <title>Social Network - Login</title>
    </head>
    <body>
        
        <header>
            <img class="logo" src="images/logo.svg" alt="logo">
        </header>
        


        <?php
            //Check errors
            if(isset($errore))
            {
                echo "<center>";
                echo "<p class='error'>";
                echo "Invalid credentials.";
                echo "</p>";
                echo "</center>";
            }
        ?>

        <main>
            <form name='nome_form' method='post'>
                <p>
                    <label>Username <input type='text' name='username'></label>
                </p>
                <p>
                    <label>Password <input type='password' name='password'></label>
                </p>
                

                <nav>
                    <ul class="nav_link">   
                        <label><input id="button" type='submit' value="Login"></label>
                        </br>
                        <li><a href="signup.php">Not registered yet?</a></li>
                        <li><a href="passwlost.php">I forgot the password</a></li>
                    </ul>
                </nav>
            </form>
        </main>

    </body>
</html>