<?php

$username = $_SESSION['username'];
$query = "SELECT * FROM `$comments` WHERE username='$username' ORDER BY timestamp DESC";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result)) {
  while($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $post_query = "SELECT * FROM `$posts` WHERE id=$post_id";
    $post_result = mysqli_query($db, $post_query);
    $post_row = mysqli_fetch_assoc($post_result);
    $post_title = $post_row['title'];

    $datetime = new DateTime($timestamp);
    $datetime->setTimezone($timezone);

?>

  <tr>
    <td style="white-space:pre-wrap"><?php echo $comment; ?></td>
    <td><?php echo $datetime->format('Y-m-d H:i:s'); ?></td>
    <td style="white-space:pre"><a href="<?php echo '/post/'.$post_id; ?>"><?php echo $post_title; ?></a></td>
    <td><a href="" data-id="<?php echo $id; ?>" data-toggle="modal" data-target="#delete-confirmation" class="delete-modal-toggle">Delete</a></td>
  </tr>

<?php } ?>

<?php } else { ?>

<tr class="text-center">
  <td colspan="6"><h3 class="text-muted">Nothing to display</h3></td>
</tr>

<?php } ?>
