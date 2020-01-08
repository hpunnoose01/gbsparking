<?php

session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");

$vote = $_POST['vote'];
$author = $_POST['author'];
// $user_id = $_POST['user_id'];
$user_id = $_SESSION['id'];

// Already voted
$query = "SELECT * FROM `$votes` WHERE author='$author' AND vote='$vote' AND user_id='$user_id'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result)) {
  $query = "DELETE FROM `$votes` WHERE author='$author' AND vote='$vote' AND user_id='$user_id'";
  $result = mysqli_query($db, $query);
  $action = "Removed";
} else {
  $query = "INSERT INTO `$votes` (author, user_id, vote) VALUES ('$author', '$user_id', '$vote')";
  $result = mysqli_query($db, $query);

  $action = "Added";
}

function countRating() {
  global $db;
  global $votes;
  global $posts;
  global $author;

  $upvote_query = "SELECT * FROM `$votes` WHERE vote='upvote' AND author = '$author'";
  $upvote_result = mysqli_query($db, $upvote_query);
  $upvote_num = mysqli_num_rows($upvote_result);

  $downvote_query = "SELECT * FROM `$votes` WHERE vote='downvote' AND author = '$author'";
  $downvote_result = mysqli_query($db, $downvote_query);
  $downvote_num = mysqli_num_rows($downvote_result);

  return $upvote_num - $downvote_num;
}

$rating = countRating();
$query = "UPDATE `$posts` SET author_rating = $rating WHERE author='$author'";
mysqli_query($db, $query);

$response = [
  "success" => true,
  "action" => $action,
];

echo json_encode($response);

?>
