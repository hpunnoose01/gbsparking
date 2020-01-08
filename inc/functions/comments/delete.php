<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");

$id = $_POST['id'];
$session_username = $_SESSION['username'];

$exist_query = "SELECT * FROM `$comments` WHERE id= $id";
$exist_result = mysqli_query($db, $exist_query);
if (mysqli_num_rows($exist_result)) {
  $exist_row = mysqli_fetch_assoc($exist_result);
  $username= $exist_row['username'];
  if ($username === $session_username) {
    $query = "DELETE FROM `$comments` WHERE id=$id";
    $result = mysqli_query($db, $query);

    $response = [
      "success" => true,
    ];
  } else {
    $response = [
      "success" => false,
      "error" => "You are not authorized to delete someone else's comment!",
    ];
  }


} else {
  $response = [
    "success" => false,
    "error" => "ID does not exist",
  ];
}

echo json_encode($response);


?>
