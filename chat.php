<?php
    session_start();
    include 'login.php';
    $user_name = "root";
    $pass_word = "root";
    $database = "chatbox";
    $server = "localhost";

    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db($database, $db_handle);

    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')){ 
        header ("Location: login.php");

    $_SESSION['username'] = $usname;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ChatApp</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body style="background-color: #aaaaaa">
    <div style="margin-right: auto; margin-left: auto">
        <h1 style="color: purple; margin-top: auto; margin-bottom: auto">Simple Chat App</h1>
        <!--div id="info" style="height: 400px"-->

            <form action="logout.php">
                <button style="background-color: blue; color: white; 
                    width:100px; box-sizing: border-box; border: 4px solid blue; border-radius: 4px;
                    margin-right: 300px; margin-bottom: auto" 
                    type="submit">                    
                    <b>Logout</b>
                </button>
            </form>
            <div class="output" style="height: 250px; width: 300px">
                <?php 
                    if($db_found){
                        $sql = "SELECT * FROM posts";
                        $result = mysql_query($sql);

                        while ($db_field = mysql_fetch_assoc($result)) {

                            print '<table><tr><th>User: ' . $db_field['name'].'</th></tr></table>';
                            print '<div> '.$db_field['message'] . "</div>"; 
                            print $db_field['date'] . "<br><br>"; 
                        }

                        mysql_close($db_handle);
                    }
                    else{
                        echo "0 results";
                        mysql_close($db_handle);

                    }
                    
                ?>
            </div>
            <form method="post" action="send.php">
                <textarea name="name" placeholder="Enter name"
                    class="form-control" style=" width:300px; border-radius: 4px; height:15px"></textarea><br>                
                <textarea name="message" placeholder="Enter message"
                    class="form-control" style="background-color:#aaaaaa; width:300px; border-radius: 4px"></textarea><br>
                <button style="background-color: #69c408; color: white; 
                    width:50px; box-sizing: border-box; border: 4px solid #69c408" 
                    type="submit">
                    <b>Send</b>
                </button>           
            </form><br>
        <!--/div-->
    </div>

</body>
</html>