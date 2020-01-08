<?php

include("config.php");

if(isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = "";
}


switch($page) {
  case 'post':
    $post_id = $_GET['post_id'];
    $query = "SELECT * FROM `$posts` WHERE id=$post_id";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    extract($row);
    $content = htmlspecialchars($content);
    $title = htmlspecialchars($title);
    $image_query = "SELECT * FROM `$images` WHERE post_id=$post_id";
    $image_result = mysqli_query($db, $image_query);
    $image_row = mysqli_fetch_assoc($image_result);
    $image = $image_row['image'];
    $meta['title']="$title | Marketplace 4989";
    $meta['description']="$content";
    $meta['url']="https://marketplace4989.herokuapp.com/post/$id";
    $meta['image']="https://marketplace4989.herokuapp.com/img/post/$image";
    $product = true;
    $meta['name']="$title";
    $meta['price']="$price";
    // $meta['item_description']="$content";
    break;

  default:
    $meta['title']="Marketplace 4989";
    $meta['description']="Sell any unwanted items to local neighbors, and buy items for cheaper price from your neighbors!";
    $meta['url']="https://marketplace4989.herokuapp.com/$page";
    $meta['image']="https://marketplace4989.herokuapp.com/img/landing.jpg";
    $product = false;
    break;
}

?>
