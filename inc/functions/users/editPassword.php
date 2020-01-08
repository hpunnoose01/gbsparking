<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");

$id = $_SESSION['id'];

$password = mysqli_real_escape_string($db, $_POST['password']);
$password = password_hash($password, PASSWORD_BCRYPT);
$query = "UPDATE `$users` SET password='$password' WHERE id=$id";
$result = mysqli_query($db, $query);
$response = [
  "success" => true,
];

echo json_encode($response);

?>
