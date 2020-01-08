<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");

$username = mysqli_real_escape_string($db, $_POST["username"]);
$password = mysqli_real_escape_string($db, $_POST["password"]);

$query = "SELECT * FROM `$users` WHERE username='$username'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
if (password_verify($password, $row['password'])) {
  $_SESSION['username'] = $row['username'];
  $_SESSION['firstname'] = $row['firstname'];
  $_SESSION['lastname'] = $row['lastname'];
  $_SESSION['email'] = $row['email'];
  $_SESSION['id'] = $row['id'];
  $_SESSION['image'] = $row['image'];
  $_SESSION['loggedIn'] = true;
  $response = [
    "success" => true,
  ];
} else {
  $response = [
    "success" => false,
  ];
}

echo json_encode($response);

?>
