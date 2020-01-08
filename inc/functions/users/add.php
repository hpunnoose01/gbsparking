<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once("../config.php");

$username = mysqli_real_escape_string($db, $_POST["username"]);
$password = mysqli_real_escape_string($db, $_POST["password"]);
$firstname = ucwords(mysqli_real_escape_string($db, $_POST["firstname"]));
$lastname = ucwords(mysqli_real_escape_string($db, $_POST["lastname"]));
$email = mysqli_real_escape_string($db, $_POST["email"]);

// Function to get the client ip address
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
$ip=get_client_ip_env();

if($ip == '216.14.62.243') {
  $response = [
    "success" => false,
    "error" => "IP blocked",
  ];
  echo json_encode($response);
  exit();
}


if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $response = [
    "success" => false,
    "error" => "Invalid Email Address.",
  ];
  echo json_encode($response);
  exit();
}

// check for existing username
$query = "SELECT * FROM `$users` WHERE username = '$username' OR email = '$email'";
$result = mysqli_query($db, $query);
if ($row = mysqli_fetch_array($result)) {
  if ($row['username'] === $username) {
    $response = [
      "success" => false,
      "error" => "Username already exists.",
    ];
  } else if ($row['email'] === $email) {
    $response = [
      "success" => false,
      "error" => "Email is already in use.",
    ];
  }
} else {
  $password = password_hash($password, PASSWORD_BCRYPT);
  $query = "INSERT INTO `$users` (username, password, firstname, lastname, email, IP_Address) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$ip')";
  $result = mysqli_query($db, $query) or die("ERROR!".mysqli_error($db));
  $_SESSION['username'] = $username;
  $_SESSION['firstname'] = $firstname;
  $_SESSION['lastname'] = $lastname;
  $_SESSION['email'] = $email;
  $_SESSION['loggedIn'] = true;
  $query = "SELECT * FROM `$users` WHERE username = '$username'";
  $result = mysqli_query($db, $query) or die("ERROR!".mysqli_error($db));
  $row = mysqli_fetch_array($result);
  $_SESSION['id'] = $row["id"];
  $response = [
    "success" => true,
  ];
}

echo json_encode($response);

?>
