<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "nominationsv1";

$connection = new mysqli($servername, $username, $password, $database);

$name = "name";
$organisation = "org";
$email = uniqid("", true);
$info = "info";
$benefit = "benefit";
$info2 = "info2";
$nominator = "nominator";
$self_nomination = "No";
$consent = "Yes";

do {
    $sql = "INSERT INTO users (name, organisation, email, info, benefit, info2, nominator, self_nomination, consent) " .
        "VALUES ('$name', '$organisation', '$email', '$info', '$benefit', '$info2', '$nominator', '$self_nomination', '$consent')";
    $result = $connection->query($sql);

    header("location: /index.php");
    exit;
} while (false);
