<?php
session_start();
include 'db.php';
include 'validation.php';

$wrong = [];

if (isset($_SESSION['login'])) {
    header('location:profile.php');
    die;
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $userEmail = loginEmail($email);
    if ($userEmail['status'] == false) {
        $wrong[] = $userEmail['err'];
    }

    $userPass = loginPass($pass);

    if ($userPass['status'] == false) {
        $wrong[] = $userPass['err'];
    }

    $sql = "SELECT *from users where user_email = '{$email}' and user_password = '{$pass}' limit 1";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    // print_r($result);
    // die;
    if (mysqli_num_rows($query) > 0) {

        $_SESSION['id'] = $result['id'];
        $_SESSION['login'] = true;
        mysqli_close($conn);
        header('location:profile.php');
        die();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-4">

        <div class="row">
            <div class="col-5 offset-3">
                <div class="card">
                    <div class="card-header text-white text-center" style="background-color: #26a69a;">
                        <span class="fa fa-user-circle fa-2x"></span>
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email">
                                <span style="color: red;">
                                    <?php
                                    if (!empty($wrong)) echo $userEmail['err'];
                                    ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pass" placeholder="Password">
                                <span style="color: red;">
                                    <?php
                                    if (!empty($wrong)) echo $userPass['err'];
                                    ?>
                                </span>
                            </div>
                            <br>
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