
<?php include("inc/header.php"); ?>


<div class="container">

  <div class="row py-3 main-body">

    <div class="px-lg-1 col-lg-3 col-12 d-lg-block">
      <?php
      if (!isset($_SESSION['loggedIn'])) {
        die("You are not logged in!");
      }
      ?>
      <?php include("inc/profileSidebar.php"); ?>

    </div>

    <div class="col-lg-9 col-12 pt-3">


      <?php

      switch ($_GET['page']) {
        case 'my-profile':
          require 'pages/myProfile.php';
          break;
        case 'my-posts':
          require 'pages/myItems.php';
          break;
        case 'my-comments':
          require 'pages/myComments.php';
          break;
        case 'my-bookmarks':
          require 'pages/myBookmarks.php';
          break;
        case 'settings':
          require 'pages/settings.php';
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
