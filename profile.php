<?php

session_start();
include 'db.php';

$id = $_SESSION['id'];

$sql = "SELECT *from users where id = '{$id}'";

$query = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- <?php include 'navbar.php'; ?> -->

    <div class="container mt-4">

        <div class="row">
            <div class="col-5 offset-3">
                <div class="card">
                    <div class="card-header text-center text-white" style="background-color: #26a69a;">
                        <h2>User Profile</h2>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <?php if (mysqli_num_rows($query) > 0) {
                                while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                            <ul class="list-group list-group-flush">
                                <img src=<?= $result['user_img'] ?> alt="">
                                <li class="list-group-item">UID : <?= $result['user_uid'] ?></li>
                                <li class="list-group-item">Name : <?= $result['user_name'] ?></li>
                                <li class="list-group-item">Age : <?= $result['user_age'] ?></li>
                                <li class="list-group-item">Mobile : <?= $result['user_mobile'] ?></li>
                                <li class="list-group-item">Address : <?= $result['user_address'] ?> -
                                    <?= $result['user_city'] ?> - <?= $result['user_pin'] ?>
                                </li>
                            </ul>
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>