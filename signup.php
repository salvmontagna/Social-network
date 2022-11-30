<?php

    require "api/conn.php";
     session_start();
    if(isset($_SESSION["username"])){
        header("Location: home.php");
        exit;
    }

    //Check and initialize POST data
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["repassword"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"])){
        //trim: remove any spaces at the beginning and end of the string
        //mysqli_real_escape: escape special characters, to avoid sql injection
        $username = trim(mysqli_real_escape_string($conn, $_POST["username"]));
        $user_passw = trim(mysqli_real_escape_string($conn, $_POST["password"]));
        $name = trim(mysqli_real_escape_string($conn, $_POST["name"]));
        $surname = trim(mysqli_real_escape_string($conn, $_POST["surname"]));
        $email = trim(mysqli_real_escape_string($conn, $_POST["email"]));
        $image = $_FILES["photo"]["name"];
        $user_repassw = trim(mysqli_real_escape_string($conn, $_POST["repassword"]));
        //Check for empty fields
        if($username === "" || $user_passw === "" || $name === "" || $surname === "" || $email === "" || $image === "" ||$user_repassw === "") $errore2=true;
        else{
           //Verify valid email, function taken from the documentation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errore3=true;
            else{
                //Check for matching passwords
                if ($user_passw !== $user_repassw) $errore4=true;
                else{
                    $query = "INSERT INTO user (username, name, surname, email, password, image) VALUES ('".$username."', '".$name."',  '".$surname."', '".$email."', '".$user_passw."','".$image."')";
                    $res = mysqli_query($conn, $query);
                    //Check query returns
                    if($res > 0){ 
                        $_SESSION["username"] = $_POST["username"];
                        header("Location: home.php");
                        echo '<script>console.log("Data sent")</script>';
                        
                        $upload_dir = "./images/user_img";

                        if (UPLOAD_ERR_OK === $_FILES['photo']['error']) {
                            $fileName = $_FILES['photo']['name'];
                            move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir.'/'.$fileName);
                        }
                    }
                    else{
                        //If $res doesn't return anything, I set an error variable
                        $errore = true;
                        echo '<script>console.log("Didnt send data")</script>';
                    }
                }
            }
        }
    }
    else{
        echo '<script>console.log("I didnt pass the asset")</script>';
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='css/signup.css'>
        <script src='js/signup.js' defer></script>
        <link rel="icon" href="images/favicon.png" type="image/png" />
        <title>Social Network - Sign up</title>
    </head>
    <body>

        <header>
                <img class="logo" src="images/logo.svg" alt="logo">
        </header>
        

        <?php
            // Verifica la presenza degli errori delle credenziali
            if(isset($errore)){
                echo "<center>";
                echo "<p class='errore'>";
                echo "Invalid credentials.";
                echo "</p>";
                echo "</center>";
            }

            if(isset($errore2)){
                echo "<center>";
                echo "<p class='errore'>";
                echo "Fill in all fields.";
                echo "</p>";
                echo "</center>";
            }

            if(isset($errore3)){
                echo "<p class='errore'>";
                echo "Invalid email.";
                echo "</p>";
            }

            if(isset($errore4)){
                echo "<center>";
                echo "<p class='errore'>";
                echo "Passwords do not match.";
                echo "</p>";
                echo "</center>";
            }

            if(isset($errore5)){
                echo "<center>";
                echo "<p class='errore'>";
                echo "You must enter the image.";
                echo "</p>";
                echo "</center>";
            }

        ?>
        <main>
            <form id="form_all" name = "form_name" method="post" enctype="multipart/form-data">
                <p>
                 <label>Name<input type="text" name="name" style = "text-transform:capitalize;"></label>
                </p>

                <p>
                 <label>Surname<input type="text" name="surname" style = "text-transform:capitalize;" ></label>
                </p>

                <p>
                    <label>E-mail<input type="text" id="emailbox" name="email">
                    </label><label id="email">
                    </label>
                </p>

                <p>
                    <label >Username<input type="text" id="usernamebox" name="username">
                    </label><label id="user">
                    </label>
                </p>

                <p>
                 <label>Password<input type="password" id="passwordbox" name="password" ></label>
                </p>

                <p>
                    <label >Confirm Password<input type="password" id="passwordbox" name="repassword">
                    </label><label id="psw">
                    </label>
                </p>

                <p>
                        <label>Profile image<input class="input_file" type="file" name="photo" accept="image/png,image/jpg,image/jpeg" ></label>
                        </p>
                <nav>
                    <ul class="nav_link">
                        <div id="last">
                            <p>
                            <label>&nbsp;<input id="button" class="file" value="Signup" type="submit" ></label>
                            </p>
                            <li><a href="login.php">or sign in</a></li>
                        </div>
                    </ul>
                </nav>  
            </form>
        </main>
    </body>
</html>

<?php


/*
//aspetto la conferma che va implementata tramite js
function checkUserExistence($conn,$username,$user_passw){
    $mysql_qry = "SELECT * FROM user WHERE username LIKE '".$username."'";
    $result = mysqli_query($conn,$mysql_qry);
    $users=array();
    if($result){
        while($user=mysqli_fetch_object($result)){
            $users[]=$user;
        }
        if(count($users)>0){
            //echo "Trovati utenti n ". count($users);
            return true;
        }
        else{
            return false;
        }
    }
    else return false;
}
*/


?>