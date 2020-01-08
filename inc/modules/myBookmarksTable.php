<?php

$user_id = $_SESSION['id'];
$query = "SELECT * FROM `$bookmarks` WHERE user_id=$user_id ORDER BY id DESC";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result)) {
  while($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $post_query = "SELECT * FROM `$posts` WHERE id=$post_id";
    $post_result = mysqli_query($db, $post_query);
    $post_row = mysqli_fetch_assoc($post_result);
    extract($post_row);

    $datetime = new DateTime($timestamp);
    $datetime->setTimezone($timezone);

?>

  <tr>
    <td style="white-space:pre"><a href="<?php echo '/post/'.$post_id; ?>"><?php echo $title; ?></a></td>
    <td><?php echo $author; ?></td>
    <td><?php echo $city.", ".$state; ?></td>
    <td><?php echo "$ ".$price; ?></td>
    <td><?php echo $datetime->format('Y-m-d H:i:s'); ?></td>
    <td><a href="/my-bookmarks" data-id="<?php echo $post_id; ?>" class="btn-bookmark">Delete</a></td>
  </tr>

<?php } ?>

<?php } else { ?>

<tr class="text-center">
  <td colspan="6"><h3 class="text-muted">No bookmarks saved.</h3></td>
</tr>

<?php } ?>
