<?php
if ( isset($_GET["id"])) {

    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "nominationsv1";

    $connection = new mysqli ($servername, $username, $password, $database);

    $sql = "DELETE FROM users WHERE id=$id";
    $connection->query($sql);

}

 header("location: /TeamProject/index.php");
 exit;

?>