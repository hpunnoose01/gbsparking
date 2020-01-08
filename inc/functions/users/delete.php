<?php

session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");
include_once("../AWS_SDK.php");

$id = $_SESSION['id'];

$exist_query = "SELECT * FROM `$users` WHERE id= $id";
$exist_result = mysqli_query($db, $exist_query);
if (mysqli_num_rows($exist_result)) {
  $row = mysqli_fetch_assoc($exist_result);
  $username = $row['username'];
  $profile_image = $row['image'];

  if($profile_image) {
    $oldPicture = "user/$profile_image";
    // chmod($oldPicture, 0644);
    // unlink($oldPicture);
    s3_delete($oldPicture);
  }

  $comment_query = "DELETE FROM `$comments` WHERE username='$username'";
  $comment_result = mysqli_query($db,$comment_query);

  $post_query = "SELECT * FROM `$posts` WHERE author='$username'";
  $post_result = mysqli_query($db, $post_query);
  while($post_row = mysqli_fetch_assoc($post_result)) {
    $post_id = $post_row['id'];

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
    $query = "DELETE FROM `$bookmarks` WHERE post_id = $post_id";
    mysqli_query($db, $query);

    $comment_query = "DELETE FROM `$comments` WHERE post_id=$post_id";
    $comment_result = mysqli_query($db, $comment_query);
  }

  $post_query = "DELETE FROM `$posts` WHERE author='$username'";
  $post_result = mysqli_query($db,$post_query);

  $query = "DELETE FROM `$votes` WHERE user_id = $id OR author = '$username'";
  $result = mysqli_query($db, $query);

  $query = "DELETE FROM `$bookmarks` WHERE user_id = $id";
  $result = mysqli_query($db, $query);

  $query = "DELETE FROM `$users` WHERE id = $id LIMIT 1";
  $result = mysqli_query($db, $query);

  session_unset();

  $response = [
    "success" => true,
  ];
} else {
  $response = [
    "success" => false,
    "error" => "ID does not exist.",
  ];
}


echo json_encode($response);


?>
