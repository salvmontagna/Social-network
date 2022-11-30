<?php

    //Start the session and then destroy it
    session_start();
    //Elimina la sessione
    session_destroy();
    //Destroyed the session, bring me back to login
    header("Location: ../login.php");
    exit;

?>


