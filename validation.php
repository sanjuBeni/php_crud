<?php
// Name Validation

function validName($name)
{
    if (empty($name)) {
        return ['status' => false, 'err' => '*Name is required'];
    } elseif (strlen($name) < 4) {
        return ['status' => false, 'err' => '*Min 4 characters allowed'];
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        return ['status' => false, 'err' => '*Alphabats allowed only'];
    }
    return ['status' => true, 'err' => ''];
}

// Age Validation 

function ageValid($age)
{
    if ($age < 18 || $age > 35) {
        return ['status' => false, 'err' => '*Age between 18-35 year'];
    }
    return ['status' => true, 'err' => ''];
}

// Password Validation

function validPassword($password)
{
    if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
        return ['status' => false, 'err' => "*Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character."];
    }
    return ['status' => true, 'err' => ""];
}

// Mobile validation

function validMobile($mobileNum)
{
    if (!preg_match("/^[0-9]{10}+$/", $mobileNum)) {
        return ['status' => false, 'err' => '*Fill valid phone number'];
    } elseif (strlen($mobileNum) < 10 || strlen($mobileNum) > 10) {
        return ['status' => false, 'err' => '*Min 10-13 number insert'];
    }
    return ['status' => true, 'err' => ''];
}

// valid email 

function validMail($email)
{
    if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
        return ['status' => false, 'err' => '*Invalid email'];
    }
    $conn = mysqli_connect("localhost", "root", "", "php_crud") or die("Connection failed");
    $sql = "select *from users where user_email='{$email}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return ['status' => false, 'err' => '*Email already exists.'];
    }
    mysqli_close($conn);
    return ['status' => true, 'err' => ''];
}

// valid City

function validCity($city)
{
    if (empty($city)) {
        return ['status' => false, 'err' => '*Fill your city.'];
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
        return ['status' => false, 'err' => '*Fill valid city'];
    }
    return ['status' => true, 'err' => ''];
}

// valid Address

function validAddress($address)
{
    if (empty($address)) {
        return ['status' => false, 'err' => '*Fill your address.'];
    }
    return ['status' => true, 'err' => ''];
}

// validation pin code

function validPinCode($pinCode)
{
    if (empty($pinCode)) {
        return ['status' => false, 'err' => '*Enter your area pin code.'];
    } elseif (strlen($pinCode) < 6) {
        return ['status' => false, 'err' => '*Pincode length is 6 digit.'];
    }
    return ['status' => true, 'err' => ''];
}


// img fun

function imgUpload($file)
{
    // print_r($file);
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $error = $file['error'];
    $size = $file['size'];
    $folder = "img/";

    $fileExtension = ['jpg', 'png', 'jpeg'];

    $imgType = explode(".", $fileName);
    $imgExt = strtolower(end($imgType));
    if (in_array($imgExt, $fileExtension)) {
        $fileNewName = rand(1000, 9999) . "." . $imgExt;
        $fileDest = $folder . $fileNewName;
        move_uploaded_file($fileTmpName, $fileDest);
        return $fileDest;
    }
}


// sanitize

function sanitize($conn, $data)
{
    return mysqli_real_escape_string($conn, $data);
}


// Login email find

function loginEmail($email)
{
    $conn = mysqli_connect("localhost", "root", "", "php_crud") or die("Connection failed");
    $sql = "select *from users where user_email = '{$email}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    // echo $row;
    // die;
    if ($row > 0) {
        return ['status' => true, 'err' => ''];
        mysqli_close($conn);
    }
    return ['status' => false, 'err' => '*Wrong Email...'];
}

// login password

function loginPass($pass)
{
    $conn = mysqli_connect("localhost", "root", "", "php_crud") or die("Connection failed");
    $sql = "select *from users where user_password = '{$pass}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return ['status' => true, 'err' => ''];
        mysqli_close($conn);
    }
    return ['status' => false, 'err' => '*Wrong Password...'];
}