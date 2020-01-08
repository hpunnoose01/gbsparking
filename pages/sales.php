<?php

  $cat = $_GET['cat'];
  $p = $_GET['p'];

  if ($cat !== "All Categories" && $cat !== "Accessaries" && $cat !== "Health And Beauty" && $cat !=="Books" && $cat !=="Furniture" && $cat !=="Clothing" && $cat !=="Sports" && $cat !=="Electronics" && $cat !=="Automotive"
 && $cat !== "Entertainment"  && $cat !== "Appliances"  && $cat !== "Pet Supplies"  && $cat !== "Kids And Babies" ) {
    die("Invalid category name");
  }
?>

<div class="row justify-content-between">
  <div class="col">
    <h2><?php echo $cat; ?></h2>
  </div>
</div>

<?php require("inc/modules/postFilter.php"); ?>

<hr class="my-4">

<div class="row">
  <?php require("inc/modules/itemList.php"); ?>
</div>

<?php require("inc/modules/pagination.php")?>
