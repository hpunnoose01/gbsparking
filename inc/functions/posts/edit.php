<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");
include_once("../AWS_SDK.php");

$post_id = $_POST['post_id'];

$verify_query = "SELECT * FROM `$posts` WHERE id=$post_id";
$result = mysqli_query($db, $verify_query);
$row = mysqli_fetch_assoc($result);
$author = $row['author'];

$category = mysqli_real_escape_string($db, $_POST['category']);
$title = mysqli_real_escape_string($db, $_POST['title']);
$content = mysqli_real_escape_string($db, $_POST['content']);
$city = ucwords(mysqli_real_escape_string($db, $_POST['city']));
$state = $_POST['state'];
$price = mysqli_real_escape_string($db, $_POST['price']);

if(isset($_POST['post-id'])) {
  $prevImage = $_POST['post-id'];
  $prevImageNum = count($prevImage);
}

if ($author === $_SESSION['username']) {
  $uploadOK = true;
  $imageUpload = false;

  $i=0;
  if(!isset($_FILES['file'])) {
    $fileArraySize = 0;
  } else {
    $fileArraySize = sizeof($_FILES['file']['name']);
  }
  while($i<$fileArraySize) {
    if($_FILES['file']['name'][$i]) {
      $imageUpload = true;
      $fileName[$i] = basename($_FILES['file']['name'][$i]);
      $fileTmpName[$i] = $_FILES['file']['tmp_name'][$i];
      $fileType = strtolower(pathinfo($fileName[$i], PATHINFO_EXTENSION));
      $fileSize = $_FILES['file']['size'][$i];

      if($fileSize > 10485760) {
        $response = [
          "success" => false,
          "error" => "File Size exceeded maximum allowance (Maximum: 10MB)",
        ];
        $uploadOK = false;
      } else if($fileType !== "jpeg" && $fileType !== "png" && $fileType !== "jpg") {
        $response = [
          "success" => false,
          "error" => "Invalid image type (Allowed types: JPEG/PNG/JPG).",
        ];
        $uploadOK = false;
      }
    }
    $i++;
  }

  if($uploadOK) {

    $query = "UPDATE `$posts` SET cat='$category', title='$title', last_modified=NOW(), content='$content', city='$city', state='$state', price=$price WHERE id=$post_id";
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

    $targetPath = "post/";
    $query = "SELECT * FROM `$images` WHERE post_id = $post_id";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)) {
      if(!in_array($row['image'], $prevImage)) {
        $prevImageDeleted = $row['image'];
        // chmod($targetPath.$prevImageDeleted, 0644);
        // unlink($targetPath.$prevImageDeleted);
        s3_delete($targetPath.$prevImageDeleted);
        $delete_query = "DELETE FROM `$images` WHERE post_id=$post_id AND image='".$prevImageDeleted."'";
        mysqli_query($db, $delete_query);
      }
    }

    for($j = 0; $j < 5; $j++) {
      if (!empty($fileName[$j])) {
        $newName[$j] = $post_id.$fileName[$j];

        // move_uploaded_file($fileTmpName[$j], $targetPath.$newName[$j]);
        s3_upload($fileTmpName[$j], $targetPath.$newName[$j]);

        $query = "INSERT INTO `$images` (image, post_id) VALUES ('".$newName[$j]."', $post_id)";
        $result = mysqli_query($db, $query);
      }
    }
  }
} else {
  $response = [
    "success" => false,
    "error" => "You are not authorized to edit someone else's post!",
  ];
}





echo json_encode($response);


?>
