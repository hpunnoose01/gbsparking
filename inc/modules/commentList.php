
<?php

$post_id = $_GET['post_id'];

$query = "SELECT * FROM `$comments` WHERE post_id=$post_id ORDER BY timestamp DESC";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result)) {
  while ($row = mysqli_fetch_assoc($result)) {
    extract($row);

    $datetime = new DateTime($timestamp);
    $datetime->setTimezone($timezone);

    $profile_query = "SELECT * FROM `$users` WHERE username='$username'";
    $profile_result = mysqli_query($db, $profile_query);
    $profile_row = mysqli_fetch_assoc($profile_result);
    $profileImage = $profile_row['image'];
    if ($profileImage) {
      $profilePath = "$s3_path/user/$profileImage";
    } else {
      $profilePath = "/img/user/no_image.png";
    }
?>
  <div class="card my-3 bg-light py-1 pr-4">
    <div class="media mt-3">
      <div class="col-3 pr-0">
        <div class="image-wrapper">
          <img src="<?php echo $profilePath; ?>" alt="" class="img-fluid" style="max-height:150px">
        </div>
      </div>
      <div class="col-9">
        <div class="media-body">
          <div class="row justify-content-between">
            <div class="col">
              <h5 class="mt-0"><?php echo $username; ?></h5>
            </div>

            <?php if ($_SESSION['username']===$username) { ?>

            <div class="col text-right">
              <i class="fa fa-trash delete-modal-toggle" style="cursor:pointer" data-toggle="modal" data-id=<?php echo $id; ?> data-target="#delete-comment-confirmation"></i>
            </div>

            <?php } ?>

          </div>
          <p><span class="badge badge-secondary"><?php echo $datetime->format('Y-m-d H:i:s'); ?></span></p>
          <p style="white-space:pre-wrap"><?php echo htmlspecialchars($comment); ?></p>
        </div>
      </div>
    </div>
  </div>

<?php } ?>
<?php } else { ?>

  <div class="container text-center py-5">
    <h3><i class="fa fa-commenting-o" aria-hidden="true"></i> There's no comment yet.</h3>
    <p class="text-muted">Be the first one to leave a comment!</p>
  </div>

<?php } ?>

<div class="modal fade" id="delete-comment-confirmation" tabIndex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Delete Post</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h3>Are You Sure?</h3>
        <p class="text-danger">This action is irreversible.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger btn-delete-comment" data-dismiss="modal">Delete Comment</button>
      </div>
    </div>
  </div>
</div>
