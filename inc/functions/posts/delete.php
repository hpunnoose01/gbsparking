<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");
include_once("../AWS_SDK.php");

$post_id = $_POST['id'];
$location = "/".$_POST['location'];
// $response->location = $location;

$exist_query = "SELECT * FROM `$posts` WHERE id= $post_id";
$exist_result = mysqli_query($db, $exist_query);
if (mysqli_num_rows($exist_result)) {
  $exist_row = mysqli_fetch_assoc($exist_result);
  $author = $exist_row['author'];
  if ($_SESSION['username'] === $author) {
    $query = "SELECT * FROM `$images` WHERE post_id=$post_id";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)) {
      $oldImage = "post/".$row['image'];
      // chmod($oldImage, 0644);
      // unlink($oldImage);
      s3_delete($oldImage);
    }
    $query = "DELETE FROM `$images` WHERE post_id=$post_id";
    mysqli_query($db, $query);

    $query = "DELETE FROM `$comments` WHERE post_id=$post_id";
    $result = mysqli_query($db, $query);

    $query = "DELETE FROM `$bookmarks` WHERE post_id = $post_id";
    $result = mysqli_query($db, $query);

    $query = "DELETE FROM `$posts` WHERE id=$post_id LIMIT 1";
    $result = mysqli_query($db, $query);

    $response = [
      "success" => true,
      "location" => $location,
    ];
  } else {
    $response = [
      "success" => false,
      "error" => "You are not authorized to delete someone else's post!",
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
