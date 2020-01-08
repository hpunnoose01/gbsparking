<?php

  session_start();

  $timezone = new DateTimeZone('America/Los_Angeles');

  include("inc/functions/dynamicMeta.php");

  $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place this data between the <head> tags of your website -->
    <title><?php echo $meta['title']; ?></title>
    <meta name="description" content="<?php echo $meta['description']; ?>">
    <link rel="canonical" href="<?php echo $meta['url']; ?>">
    <link rel="icon" href="favicon.ico">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="<?php echo $meta['title']; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="<?php echo $meta['image']; ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo $meta['title']; ?>" >
    <meta property="og:url" content="<?php echo $meta['url']; ?>" >
    <meta property="og:image" content="<?php echo $meta['image']; ?>" >
    <meta property="og:description" content="<?php echo $meta['description']; ?>" >
    <meta property="og:site_name" content="Marketplace 4989" >

    <?php if($product) { ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo $meta['name']; ?>">
    <meta itemprop="description" content="<?php echo $meta['item_description']; ?>">
    <meta itemprop="image" content="<?php echo $meta['image']; ?>">

    <meta name="twitter:data1" content="$<?php echo $meta['price']; ?>">
    <meta name="twitter:label1" content="Price">

    <meta property="og:price:amount" content="<?php echo $meta['price']; ?>" >
    <meta property="og:price:currency" content="USD" >

    <?php } ?>

    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="/styles/style.css">
  </head>
  <body>

  <?php
  if (!isset($_GET['page'])) {
    require("pages/landing.php");
  } else if ($_GET['page']==='sign-up') {
    require("pages/sign-up.php");
  } else if ($_GET['page']==='my-profile' || $_GET['page']==='my-posts' || $_GET['page']==='my-comments' || $_GET['page']==='my-bookmarks' || $_GET['page']==='settings') {
    require("userProfile.php");
  } else if ($_GET['page']==='home' || $_GET['page']==='about' || $_GET['page']==='sales' || $_GET['page']==='search' || $_GET['page']==='add-post' || $_GET['page']==='edit-post' || $_GET['page']==='post'){
    require("mainPages.php");
  } else {
    header('Location: /');
  }

  ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

    <script type="text/javascript" src="/scripts/script.min.js"></script>
    <script type="text/javascript" src="/scripts/ajax.min.js"></script>

  </body>
</html>
