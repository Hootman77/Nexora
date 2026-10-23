<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "nominationsv1";



$name = "";
$organisation = "";
$email = "";
$info = "";
$benefit = "";
$info2 = "";
$nominator = "";
$self_nomination = "";
$consent = "";

$connection = new mysqli($servername, $username, $password, $database);


$sucessMessage = "";
$errorMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $name = $_POST["name"];
    $organisation = $_POST["organisation"];
    $email = $_POST["email"];
    $info = $_POST["info"];
    $benefit = $_POST["benefit"];
    $info2 = $_POST["info2"];
    $nominator = $_POST["nominator"];
    $self_nomination = $_POST["self_nomination"];
    $consent = $_POST["consent"];

    do {

        if ( empty($name) || empty($organisation) || empty($email) || empty($info) || empty($benefit) || empty($info2) || empty($nominator) || empty($self_nomination) || empty($consent)) {
            $errorMessage = "Please complete all fields."; 
            break;
        }
            $sql = "INSERT INTO users (name, organisation, email, info, benefit, info2, nominator, self_nomination, consent) " .
       "VALUES ('$name', '$organisation', '$email', '$info', '$benefit', '$info2', '$nominator', '$self_nomination', '$consent')";
            $result = $connection->query($sql);  
            
            if (!$result) {
                $errorMessage = "Invalid Query: " . $connection->error;
                break;
            } 

    $name = "";
    $organisation = "";
    $email = "";
    $info = "";
    $benefit = "";
    $info2 = "";
    $nominator = "";
    $self_nomination = "";
    $consent = "";

    $sucessMessage = "Nomination Successful"; 

        header("location: /index.php");
        exit;

    } while (false);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Nominations</h2>

    <?php
    if (!empty($errorMessage)) {
    echo "
    <h2>$errorMessage</h2>
    ";}
    ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Organisation</label>
                <input type="text" class="form-control" name="organisation" value="<?php echo $organisation;?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">What Changed?</label>
                <input type="text" class="form-control" name="info" value="<?php echo $info; ?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Who Benefited?</label>
                <input type="text" class="form-control" name="benefit" value="<?php echo $benefit; ?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">How you know they made a difference?</label>
                <input type="text" class="form-control" name="info2" value="<?php echo $info2; ?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nominator</label>
                <input type="text" class="form-control" name="nominator" value="<?php echo $nominator; ?>">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Are you nominating yourself?</label> &nbsp;
                <input type="radio" class="form-check-input" name="self_nomination" 
                id="Yes" value="Yes">
                <label for="yes" class="form-input-label">Yes</label> &nbsp;
                 <input type="radio" class="form-check-input" name="self_nomination" 
                id="No" value="No">
                <label for="No" class="form-input-label">No</label><?php echo $self_nomination; ?>
            </div>
            <br>
            <div class="row mb-3">
                <label class=" col-sm-3 col-form-label">Do you consent?</label> &nbsp;
                <input type="radio" class="form-check-input" name="consent" 
                id="yes" value="Yes">
                <label for="yes" class="form-input-label">Yes</label> &nbsp;
                 <input type="radio" class="form-check-input" name="consent" 
                id="No" value="No">
                <label for="No" class="form-input-label">No</label>
                <?php echo $consent; ?>
            </div>

            <?php 

            if ( !empty($sucessMessage) ){
                echo "
                <h2>$sucessMessage</h2>";
            }

            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
