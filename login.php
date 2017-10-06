<?php

    $uname = "m";
    $pword = "";
    $errorMessage = "";

    function quote_smart($value, $handle) {

       if (get_magic_quotes_gpc()) {
           $value = stripslashes($value);
       }

       if (!is_numeric($value)) {
           $value = "'" . mysql_real_escape_string($value, $handle) . "'";
       }
       return $value;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname = $_POST['username'];
        $pword = $_POST['password'];

        $uname = htmlspecialchars($uname);
        $pword = htmlspecialchars($pword);

        //connect to database
        $user_name = "root";
        $pass_word = "root";
        $database = "chatbox";
        $server = "localhost";

        $db_handle = mysql_connect($server, $user_name, $pass_word);
        $db_found = mysql_select_db($database, $db_handle);

        if ($db_found) {

            $uname = quote_smart($uname, $db_handle);
            $pword = quote_smart($pword, $db_handle);

            $SQL = "SELECT * FROM register WHERE username = $uname AND password = md5($pword)";
            $result = mysql_query($SQL);
            $num_rows = mysql_num_rows($result);

            if ($result) {
                if ($num_rows > 0) {
                    session_start();
                    $_SESSION['login'] = "1";
                    header ("Location: chat.php");
                }
                else {
                    session_start();
                    $_SESSION['login'] = "";

                    header ("Location: index.php");
                }   
            }
            else {
                $errorMessage = "Error logging on";
            }

        mysql_close($db_handle);

        }

        else {
            $errorMessage = "Error logging on";
        }
        print $errorMessage;
    }


?>