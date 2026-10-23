<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Nominations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Nominations</h2>
        
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Orginisation</th>
                    <th>Email</th>
                    <th>Info</th>
                    <th>Benefit</th>
                    <th>Info2</th>
                    <th>Nominator</th>
                    <th>Self nomination</th>
                    <th>Consent</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $database = "nominationsv1";

                $connection = new mysqli($servername, $username, $password, $database);


                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while($row = $result-> fetch_assoc()) {
                    echo "
                        <tr>
                        <td>$row[name]</th>
                        <td>$row[organisation]</th>
                        <td>$row[email]</th>
                        <td>$row[info]</th>
                        <td>$row[benefit]</th>
                        <td>$row[info2]</th>
                        <td>$row[nominator]</th>
                        <td>$row[self_nomination]</th>
                        <td>$row[consent]</th>
                        <td>$row[created_at]</th>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/delete.php?id=$row[id]'> Delete</a>
                            <a class='btn btn-primary btn-sm' href='/publish.php?id=$row[id]'> Publish</a>
                            </td>
                </tr>

                    ";
                }


                ?>
              

        </table>
    </div>
</body>
</html>
