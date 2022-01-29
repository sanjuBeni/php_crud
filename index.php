<?php
session_start();
include "db.php";

$sql = "SELECT *from users";
$query = mysqli_query($conn, $sql) or die("Query Failed");

$row = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user list</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-4">

        <table class='table table-bordered text-center table-striped'>
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Photo</th>
                    <th>Edit/Detete</th>
                </tr>
            </thead>
            <?php if ($row > 0) {
                while ($res = mysqli_fetch_assoc($query)) {
            ?>
            <tbody>
                <tr>
                    <td><?= $res['user_uid'] ?></td>
                    <td><?= $res['user_name'] ?></td>
                    <td><?= $res['user_age'] ?></td>
                    <td><?= $res['user_mobile'] ?></td>
                    <td><?= $res['user_email'] ?></td>
                    <td><?= $res['user_address'] ?>, <?= $res['user_city'] ?> - <?= $res['user_pin'] ?></td>
                    <td><img src=<?= $res['user_img'] ?> alt="" width="80" height="80"></td>
                    <td>
                        <a class="btn btn-warning" href="register.php?id=<?= $res['id'] ?>"><span class="fa fa-edit"
                                onclick="return confirm('Are you want to update your data.')"></span></a>
                        <a class="btn btn-danger" href="delete.php?id=<?= $res['id'] ?>"><span class=" fa
                            fa-times-rectangle-o"
                                onclick="return confirm('Are you want to remove your data.')"></span></a>
                    </td>
                </tr>
                <?php
                }
            }
                ?>


    </div>
</body>

</html>