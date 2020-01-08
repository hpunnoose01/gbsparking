
<?php if(isset($_SESSION['loggedIn'])) { ?>

<div class="card p-4 my-3">
  <h4><a class="text-dark" href="/my-bookmarks"><i class="fa fa-bookmark" aria-hidden="true"></i> My Bookmarks</a></h4>

  <?php

  $user_id = $_SESSION['id'];

  $query = "SELECT * FROM `$bookmarks` WHERE user_id = $user_id ORDER BY id DESC LIMIT 8";
  $result = mysqli_query($db, $query) or die(mysqli_error($db));

  if (mysqli_num_rows($result)) {
    echo "<ul style='line-height: 2rem;'>";
    while ($row = mysqli_fetch_assoc($result)) {
      $post_id = $row['post_id'];

      $post_query = "SELECT * FROM `$posts` WHERE id = $post_id";
      $post_result = mysqli_query($db, $post_query);
      $post_row = mysqli_fetch_assoc($post_result);
      $post_id = $post_row['id'];
      $city = $post_row['city'];
      $state = $post_row['state'];
      $price = $post_row['price'];
      $title = $post_row['title'];
  ?>

  <li>
    <a class="text-dark" href="/post/<?php echo $post_id; ?>" data-toggle="tooltip" data-html="true" title="Location: <?php echo $city.", ".$state; ?><br/>Price: $ <?php echo $price; ?>">
      <?php echo $title; ?>
    </a>
  </li>

  <?php }
    echo "</ul>";
  } else { ?>
    No bookmarks saved.
  <?php } ?>

</div>

<?php } ?>
