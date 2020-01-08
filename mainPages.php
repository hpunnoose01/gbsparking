
<?php include("inc/header.php"); ?>

<div class="container">
  <div class="row py-3 main-body">

    <div class="px-lg-1 col-md-4 d-none d-lg-block">

      <?php include("inc/sidebar.php"); ?>

    </div>

    <div class="col-lg-8 col-12">

      <?php

      switch ($_GET['page']) {
        case 'home':
          require 'pages/home.php';
          break;
        case 'about':
          require 'pages/about.php';
          break;
        case 'sales':
          require 'pages/sales.php';
          break;
        case 'search':
          require 'pages/search.php';
          break;
        case 'post':
          require 'pages/post.php';
          break;
        case 'add-post':
          require 'pages/addPost.php';
          break;
        case 'edit-post':
          require 'pages/editPost.php';
          break;
        default:
          header('HTTP/1.0 404 Not Found');
          break;
      }

      ?>

    </div>


  </div>
</div>

<?php include("inc/footer.php"); ?>
