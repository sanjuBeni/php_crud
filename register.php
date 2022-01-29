<?php
session_start();
include "insert-data.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header text-white text-center" style="background-color: #26a69a;">
                        <span class="fa fa-user-circle fa-2x"></span>
                        <h2>New User Register </h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <?php

                            if (isset($_GET['id'])) {

                            ?>
                            <div class="form-group">
                                <label>UID</label>
                                <input type="text" class="form-control" readonly value=<?php echo $uid ?>>
                            </div>

                            <?php } ?>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"
                                    value=<?php if (isset($_GET['id'])) echo $uName ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userName['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Age</label>
                                <input type="text" name="age" class="form-control" id="age" placeholder="Enter age"
                                    value=<?php if (isset($_GET['id'])) echo $uAge ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userAge['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                    placeholder="Enter mobile" value=<?php if (isset($_GET['id'])) echo $uMobile ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userMobile['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email" value=<?php if (isset($_GET['id'])) echo $uEmail ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userEmail['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" id="pass" placeholder="Password"
                                    value=<?php if (isset($_GET['id'])) echo $uPassword ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userPass['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Enter address" value=<?php if (isset($_GET['id'])) echo $uAddress ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userAddress['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" id="city" placeholder="Enter city"
                                    value=<?php if (isset($_GET['id'])) echo $uCity ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userCity['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Pin Code</label>
                                <input type="text" name="pin" class="form-control" id="pin" placeholder="Enter pin code"
                                    value=<?php if (isset($_GET['id'])) echo $uPin ?>>
                                <span style="color:red;">
                                    <?php
                                    if (!empty($err)) {
                                        echo $userPin['err'];
                                    }
                                    ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <input type="file" name="img" class="form-control">
                                <?php if (isset($_GET['id'])) {  ?>
                                <img src=<?php echo $uImg ?> alt="" width="80" height="80">
                                <?php } ?>
                            </div><br>

                            <button type="submit" name="submit" class="btn text-white"
                                style="background-color: #26a69a;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>