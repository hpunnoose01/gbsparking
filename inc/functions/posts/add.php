<?php

session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config.php");
include_once("../AWS_SDK.php");

$author = $_SESSION['username'];
$category = mysqli_real_escape_string($db, $_POST['category']);
$title = mysqli_real_escape_string($db, $_POST['title']);
$content = mysqli_real_escape_string($db, $_POST['content']);
$city = ucwords(mysqli_real_escape_string($db, $_POST['city']));
$state = $_POST['state'];
$price = mysqli_real_escape_string($db, $_POST['price']);

$uploadOK = true;
$imageUpload = false;

$i=0;
while($i<sizeof($_FILES['file']['name'])) {
  if($_FILES['file']['name'][$i]) {
    $imageUpload = true;
    $fileName[$i] = basename($_FILES['file']['name'][$i]);
    $fileTmpName[$i] = $_FILES['file']['tmp_name'][$i];
    $fileType = strtolower(pathinfo($fileName[$i], PATHINFO_EXTENSION));
    $fileSize = $_FILES['file']['size'][$i];

    if($fileSize > 10485760) {
      $response = [
        "success" => false,
        "error" => "File Size exceeded maximum allowance (Maximum: 10MB/image)",
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

if ($uploadOK) {
  $query = "INSERT INTO `$posts` (cat, title, author, content, city, state, price, last_modified) VALUES ('$category','$title','$author','$content','$city', '$state',$price, NOW())";
  $result = mysqli_query($db, $query);
  $id = mysqli_insert_id($db);

  if ($result) {
    $response = [
      "success" => true,
      "id" => $id,
    ];
  } else {
    $response = [
      "success" => false,
      "error" => "A connection error has occurred. Please try again later.",
    ];
  }

  if($imageUpload) {
    for($i = 0; $i < 5; $i++) {
      if (!empty($fileName[$i])) {
        $newName[$i] = $id.$fileName[$i];
        $targetPath = "post/";

        // move_uploaded_file($fileTmpName[$i], $targetPath.$newName[$i]);
        s3_upload($fileTmpName[$i], $targetPath.$newName[$i]);

        $query = "INSERT INTO `$images` (image, post_id) VALUES ('".$newName[$i]."', $id)";
        $result = mysqli_query($db, $query);
      }

    }

  }

}




echo json_encode($response);


?>
