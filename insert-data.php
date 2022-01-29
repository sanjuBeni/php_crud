<?php

include "db.php";
include "validation.php";

$err = [];

if (isset($_GET['id'])) {
    $id = sanitize($conn, $_GET['id']);
    $sql = "SELECT *from users where id = '{$id}'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    $uName = $result['user_name'];
    $uAge = $result['user_age'];
    $uMobile = $result['user_mobile'];
    $uEmail = $result['user_email'];
    $uPassword = $result['user_password'];
    $uAddress = $result['user_address'];
    $uCity = $result['user_city'];
    $uPin = $result['user_pin'];
    $uImg = $result['user_img'];
    $uid = $result['user_uid'];
}

if (isset($_POST['submit']) && !isset($_GET['id'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $file = $_FILES['img'];

    $fileDest = imgUpload($file);
    // echo $fileDest;
    // die;

    $userName = validName($name);

    if ($userName['status'] == false) {
        $err[] = $userName['err'];
    }

    $userAge = ageValid($age);

    if ($userAge['status'] == false) {
        $err[] = $userAge['err'];
    }

    $userMobile = validMobile($mobile);

    if ($userMobile['status'] == false) {
        $err[] = $userMobile['err'];
    }

    $userEmail = validMail($email);

    if ($userEmail['status'] == false) {
        $err[] = $userEmail['err'];
    }

    $userPass = validPassword($pass);

    if ($userPass['status'] == false) {
        $err[] = $userPass['err'];
    }

    $userAddress = validAddress($address);

    if ($userAddress['status'] == false) {
        $err[] = $userAddress['err'];
    }

    $userCity = validCity($city);

    if ($userCity['status'] == false) {
        $err[] = $userCity['err'];
    }

    $userPin = validPinCode($pin);

    if ($userPin['status'] == false) {
        $err[] = $userPin['err'];
    }
    // function data()
    // {
    //     return "data is required";
    // }
    // $err[] = data();
    // print_r($err);
    // die;

    if (empty($err)) {
        $uid = rand(100000, 999999);

        $sql = "INSERT INTO users(`user_name`, `user_age`, `user_mobile`, `user_email`, `user_password`, `user_address`, `user_city`, `user_pin`, `user_img`, `user_uid`) 
        VALUES ('{$name}','{$age}','{$mobile}','{$email}','{$pass}','{$address}','{$city}','{$pin}','{$fileDest}','{$uid}')";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header('location:index.php');
        } else {
            echo "<script>Data not inserted</script>";
        }
    }
}

if (isset($_POST['submit']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $file = $_FILES['img'];

    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    // $err = $file['err'];
    $size = $file['size'];
    $folderData = "img/";
    $fileDest1 = "";

    $fileExtension = ['jpg', 'png', 'jpeg'];

    $imgType = explode(".", $fileName);
    $imgExt = strtolower(end($imgType));
    if (in_array($imgExt, $fileExtension)) {
        $fileNewName = rand(1000, 9999) . "." . $imgExt;
        $fileDest1 = $folderData . $fileNewName;
        move_uploaded_file($fileTmpName, $fileDest1);
    }
    // var_dump($fileDest1);
    // die;

    $userName = validName($name);

    if ($userName['status'] == false) {
        $err[] = $userName['err'];
    }

    $userAge = ageValid($age);

    if ($userAge['status'] == false) {
        $err[] = $userAge['err'];
    }

    $userMobile = validMobile($mobile);

    if ($userMobile['status'] == false) {
        $err[] = $userMobile['err'];
    }

    $userEmail = validMail($email);

    if ($userEmail['status'] == false) {
        $err[] = $userEmail['err'];
    }

    $userPass = validPassword($pass);

    if ($userPass['status'] == false) {
        $err[] = $userPass['err'];
    }

    $userAddress = validAddress($address);

    if ($userAddress['status'] == false) {
        $err[] = $userAddress['err'];
    }

    $userCity = validCity($city);

    if ($userCity['status'] == false) {
        $err[] = $userCity['err'];
    }

    $userPin = validPinCode($pin);

    if ($userPin['status'] == false) {
        $err[] = $userPin['err'];
    }

    // print_r($err);
    // die;
    if (empty($err)) {
        if ($fileDest1 == "") {
            // var_dump($fileDest1);
            // die;

            $sql = "UPDATE users set user_name='{$name}', user_age='{$age}', user_mobile='{$mobile}',
          user_email='{$email}', user_password='{$pass}', user_address='{$address}', 
          user_city='{$city}', user_pin='{$pin}' where id = '{$id}' ";

            mysqli_query($conn, $sql) or die("Query failed");
            mysqli_close($conn);

            header("Location:index.php");
        } else {
            // echo 1234;
            // var_dump($fileDest1);
            // die;

            $sql = "UPDATE users set user_name='{$name}', user_age='{$age}', user_mobile='{$mobile}',
            user_email='{$email}', user_password='{$pass}', user_address='{$address}', 
            user_city='{$city}', user_pin='{$pin}', user_img='{$fileDest1}' where id = '{$id}' ";
            mysqli_query($conn, $sql) or die("Query failed");
            mysqli_close($conn);
            header("Location:index.php");
        }
    }
}