<?php

$username = $_SESSION['username'];
$query = "SELECT * FROM `$posts` WHERE author='$username' ORDER BY timestamp DESC";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result)) {
while($row = mysqli_fetch_assoc($result)) {
  extract($row);

  $datetime = new DateTime($timestamp);
  $datetime->setTimezone($timezone);
?>

  <tr>
    <td><a href="<?php echo '/post/'.$id; ?>"><?php echo $title; ?></a></td>
    <td><?php echo $datetime->format('Y-m-d H:i:s'); ?></td>
    <td><?php echo $cat; ?></td>
    <td><?php echo $price; ?></td>
    <td><a href="<?php echo '/edit-post/'.$id; ?>">Edit</a></td>
    <td><a href="" data-id="<?php echo $id; ?>" data-toggle="modal" data-target="#delete-confirmation" class="delete-modal-toggle">Delete</a></td>
  </tr>

<?php } ?>



<?php } else { ?>

<tr class="text-center">
  <td colspan="6"><h3 class="text-muted">Nothing to display</h3></td>
</tr>


<?php } ?>
