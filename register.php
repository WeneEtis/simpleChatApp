<?php

    $uname = "";
    $pword = "";
    $errorMessage = "";
    $num_rows = 0;

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

            //user and pwd checked for unknoown char
            $uname = $_POST['username'];
            $pword = $_POST['password'];

            //$uname = htmlspecialchars($uname);
            //$pword = htmlspecialchars($pword);

            //checking the length of password and username

            $uLength = strlen($uname);
            $pLength = strlen($pword);

            if ($uLength >= 5 && $uLength <= 20) {
                $errorMessage = "";
                $_SESSION['msg'] = $errorMessage;
            }
            else {
                $errorMessage = $errorMessage . "Username must be between 5 and 20 characters" . "<BR>";
                $_SESSION['msg'] = $errorMessage;

            }

            if ($pLength >= 8 && $pLength <= 16) {
                $errorMessage = "";
                $_SESSION['msg'] = $errorMessage;

            }
            else {
                $errorMessage = $errorMessage . "Password must be between 8 and 16 characters" . "<BR>";
                $_SESSION['msg'] = $errorMessage;

            }

            //connect to the database
            if ($errorMessage == "") {

                $user_name = "root";
                $pass_word = "root";
                $database = "chatbox";
                $server = "localhost";

                $db_handle = mysql_connect($server, $user_name, $pass_word);
                $db_found = mysql_select_db($database, $db_handle);

                if ($db_found) {

                    $uname = quote_smart($uname, $db_handle);
                    $pword = quote_smart($pword, $db_handle);

                    //check that the uname is not taken
                    $SQL = "SELECT * FROM register WHERE username = $uname";
                    $result = mysql_query($SQL);
                    $num_rows = mysql_num_rows($result);

                    if ($num_rows > 0) {
                        $errorMessage = "Username already taken";
                    }
                    
                    else {
                        $SQL = "INSERT INTO register (username, password) VALUES ($uname, md5($pword))";
                        $result = mysql_query($SQL);
                        mysql_close($db_handle);

                        session_start();
                        $_SESSION['login'] = "1";
                        //$_SESSION['username'] = $uname;

                        header ("Location: index.php");

                    }

                }
                else {
                    $errorMessage = "Database Not Found";
                }

            }
        print $errorMessage;

    }

?>