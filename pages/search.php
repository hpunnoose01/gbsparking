<?php

  $q = $_GET['q'];
  $p = $_GET['p'];

  $query = "SELECT * FROM `$posts` WHERE title LIKE '%$q%' OR content LIKE '%$q%' ORDER BY timestamp DESC";
  $result = mysqli_query($db, $query);
  $num_result = mysqli_num_rows($result);

?>

<div class="jumbotron jumbotron-fluid w-100 py-2">
  <div class="container">
  <h3>Search Result for: <?php echo $q; ?></h3>
  <hr>
  <?php if ($num_result === 0) { ?>

    <h1 class="text-center text-info"><i class="fa fa-info-circle" aria-hidden="true"></i> No Matching Result</h1>
    <h4 class="text-center">Try Different Search Keywords.</h4>

  <?php } else if ($num_result === 1) { ?>

    <p class="text-muted">There is <span class="text-info">1</span> result.</p>

  <?php } else { ?>

    <p class="text-muted">There are <span class="text-info"><?php echo $num_result; ?></span> results.</p>

  <?php } ?>

  </div>
</div>
<?php require("inc/modules/postFilter.php"); ?>

<hr class="my-4">

<div class="row">
  <?php require("inc/modules/itemList.php"); ?>
</div>

<?php require("inc/modules/pagination.php")?>
