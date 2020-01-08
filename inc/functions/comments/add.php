<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once("../config.php");

$username = $_POST['username'];
$post_id = $_POST['post_id'];
$comment = mysqli_real_escape_string($db, $_POST['comment']);

$query = "INSERT INTO `$comments` (username, post_id, comment) VALUES ('$username','$post_id','$comment')";
$result = mysqli_query($db, $query);

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
