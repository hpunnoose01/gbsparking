<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");
include_once("../AWS_SDK.php");

$id = $_SESSION['id'];
$email = mysqli_real_escape_string($db, $_POST['email']);

if($_FILES['file']['name']) {
  $fileName = basename($_FILES['file']['name']);
  // $fileType = $_FILES['file']['type'];
  $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  $fileSize = $_FILES['file']['size'];

  if($fileSize > 10485760) {
    $response = [
      "success" => false,
      "error" => "File Size exceeded maximum allowance (Maximum: 10MB)",
    ];
  } else if($fileType !== "jpeg" && $fileType !== "png" && $fileType !== "jpg") {
    $response = [
      "success" => false,
      "error" => "Invalid image type (Allowed types: JPEG/PNG/JPG).",
    ];
  } else {

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $response = [
        "success" => false,
        "error" => "Invalid Email Address.",
      ];
    } else {
      $query = "SELECT * FROM `$users` WHERE email = '$email' AND NOT id = $id";
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result)) {
        $response = [
          "success" => false,
          "error" => "Email already in use.",
        ];
      } else {
        $query = "UPDATE `$users` SET email='$email' WHERE id=$id";
        $result = mysqli_query($db, $query);
        $response = [
          "success" => true,
        ];
      }
    }

    $newName = $id.$fileName;
    $targetPath = "user/";

    $query = "SELECT * FROM `$users` WHERE id=$id";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $prevImage = $row['image'];
    if($prevImage) {
      // unlink($targetPath.$prevImage);
      s3_delete($targetPath.$prevImage);
    }

    // move_uploaded_file($_FILES['file']["tmp_name"], $targetPath.$newName);
    s3_upload($_FILES['file']['tmp_name'], $targetPath.$newName);

    $query = "UPDATE `$users` SET image='$newName' WHERE id=$id";
    $result = mysqli_query($db, $query);
  }

} else {
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = [
      "success" => false,
      "error" => "Invalid Email Address.",
    ];
  } else {
    $query = "SELECT * FROM `$users` WHERE email = '$email' AND NOT id = $id";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result)) {
      $response = [
        "success" => false,
        "error" => "Email already in use.",
      ];
    } else {
      $query = "UPDATE `$users` SET email='$email' WHERE id=$id";
      $result = mysqli_query($db, $query);
      $response = [
        "success" => true,
      ];
    }
  }
}


echo json_encode($response);

?>
