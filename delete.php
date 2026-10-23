<?php
if ( isset($_GET["id"])) {

    $id = $_GET["id"];

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "nominationsv1";

    $connection = new mysqli ($servername, $username, $password, $database);

    $sql = "DELETE FROM users WHERE id=$id";
    $connection->query($sql);

}

 header("location: /index.php");
 exit;

?>
