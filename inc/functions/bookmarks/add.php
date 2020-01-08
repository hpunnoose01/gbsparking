<?php

session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once("../config.php");

$user_id = $_SESSION['id'];
$post_id = mysqli_real_escape_string($db, $_POST['post_id']);

$query = "SELECT * FROM `$bookmarks` WHERE user_id = $user_id AND post_id = $post_id";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result)) {
  $query = "DELETE FROM `$bookmarks` WHERE user_id = $user_id AND post_id = $post_id";
  $result = mysqli_query($db, $query);
} else {
  $query = "INSERT INTO `$bookmarks` (user_id, post_id) VALUES ($user_id, $post_id)";
  $result = mysqli_query($db, $query);
}

if ($result) {
  $response = [
    "success" => true,
  ];
} else {
  $response = [
    "success" => false,
    "error" => "A connection error has occurred. Please try again later.",
  ];
}

echo json_encode($response);


?>
