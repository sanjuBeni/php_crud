<?php

include "db.php";

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = '{$id}'";

mysqli_query($conn, $sql);
mysqli_close($conn);
header('location:index.php');