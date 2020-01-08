<?php

if (mysqli_num_rows($result)) {
  while($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $title = htmlspecialchars($row['title']);
    $city = htmlspecialchars($row['city']);
    $state = htmlspecialchars($row['state']);
    $timestamp = $row['timestamp'];
    $price = htmlspecialchars($row['price']);

    $datetime = new DateTime($timestamp);
    $datetime->setTimezone($timezone);

    $image_query = "SELECT * FROM `$images` WHERE post_id=$id";
    $image_result = mysqli_query($db, $image_query);
    $image_row = mysqli_fetch_assoc($image_result);
    $image = $image_row['image'];
    if($image) {
      $postImage = "$s3_path/post/".$image;
    } else {
      $postImage = "/img/no-image-available.jpg";
    }
?>

  <div class="col-12 col-sm-6 col-lg-4 mb-2">
    <a href="/post/<?php echo $id; ?>">
    <div class="card h-100">
      <div class="card-img-top text-center image-wrapper item-list">
        <img class="d-block" src="<?php echo $postImage; ?>" alt="card">
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <p class="text-muted"><?php echo "$city, $state"; ?></p>
        <p><span class="badge badge-dark"><?php echo $datetime->format('Y-m-d H:i:s'); ?></span></p>
        <p class="card-text">$ <?php echo $price ?></p>
      </div>
    </div>
    </a>
  </div>


<?php } ?>
<?php } else { ?>
  <div class="text-center container">
    <h2>Nothing to display</h2>
  </div>
<?php } ?>
