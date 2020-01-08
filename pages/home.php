<?php

$query = "SELECT * FROM `$posts` ORDER BY timestamp DESC LIMIT 6";
$result = mysqli_query($db, $query);

?>

<h2>Browse by Categories</h2>
<div class="row">
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Health+And+Beauty">
      <img src="/img/category/healthandbeauty.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Health & Beauty</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Clothing">
      <img src="/img/category/clothing.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Clothing</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Accessaries">
      <img src="/img/category/accessaries.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Accessaries</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Furniture">
      <img src="/img/category/furniture.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Furniture</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Appliances">
      <img src="/img/category/appliances.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Appliances</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Electronics">
      <img src="/img/category/electronics.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Electronics</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Books">
      <img src="/img/category/books.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Books</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Entertainment">
      <img src="/img/category/entertainment.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Entertainment</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Pet+Supplies">
      <img src="/img/category/petsupplies.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Pet Supplies</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Kids+And+Babies">
      <img src="/img/category/kidsandbabies.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Kids & Babies</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Sports">
      <img src="/img/category/sports.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Sports</p>
    </a>
  </div>
  <div class="col-6 col-sm-3 text-center cat-link">
    <a href="/sales/Automotive">
      <img src="/img/category/automotive.jpg" alt="" class="img-fluid rounded-circle">
      <p class="lead text-center text-dark">Automotive</p>
    </a>
  </div>
</div>

<h2>Recently Uploaded</h2>
<hr class="my-4">

<div class="row">
  <?php require("inc/modules/itemList.php"); ?>
</div>
