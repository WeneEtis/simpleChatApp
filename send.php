<?php

    $message = "";
    $uname = "";
    $errorMessage = "";

    $message = $_POST['message'];
    $uname = $_POST['name'];

    $user_name = "root";
    $pass_word = "root";
    $database = "chatbox";
    $server = "localhost";

    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db($database, $db_handle);


    $sql = "INSERT INTO posts(message,name) VALUES ('$message', '$uname')";
    if ($db_found) {
        $result = mysql_query($sql); 
                mysql_close($db_handle);

        header("Location: chat.php");

    }
    else {
        $errorMessage = "Error logging on";
    }
    //print $errorMessage;

?>
