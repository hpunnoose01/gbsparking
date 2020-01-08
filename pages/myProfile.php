<?php

  $session_id=$_SESSION['id'];
  $query="SELECT * FROM `$users` WHERE id=$session_id";
  $result=mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  extract($row);

if ($image) {
  $imagePath = "$s3_path/user/$image";
} else {
  $imagePath = "/img/user/no_image.png";
}
?>

<div class="jumbotron mx-lg-5">
  <div class="container">
    <h1>My Profile</h1>
    <hr class="my-2">
    <form id="edit-profile-form" method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" disabled class="form-control" value="<?php echo $username; ?>">
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>First Name</label>
            <input type="text" disabled class="form-control" value="<?php echo htmlspecialchars($firstname); ?>">
          </div>
          <div class="col-md-6">
            <label>Last Name</label>
            <input type="text" disabled class="form-control" value="<?php echo htmlspecialchars($lastname); ?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" id="email" name="email">
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-6">
            <label>Current Profile Picture</label>
              <div class="image-wrapper my-profile">
                <img class="img-fluid" src="<?php echo $imagePath; ?>" alt="">
              </div>
          </div>
          <div class="col-6">
            <label>Preview</label>
            <div class="image-wrapper my-profile">
              <img class="img-fluid" id="profile-preview" src="/img/no-image-available.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-lg-6 col-md-10 col-12">
            <input type="file" id="profile-picture" class="form-control" name="file">
          </div>
        </div>
      </div>
      <div class='alert alert-danger edit-profile-error error' role='alert'>
      </div>
      <div class="text-center">
        <img src="/img/loading.gif" alt="" height="30px" class="loading mx-auto loading-edit-profile">
        <button class="btn btn-outline-info mr-sm-3 btn-edit-profile" type="submit" disabled>Update</button>
        <button class="btn btn-outline-warning btn-reset" type="reset" disabled>Reset</button>
      </div>
    </form>
    <hr class="my-4">
    <form id="edit-password-form">
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Password</label>
            <input type="password" class="form-control" id="password">
          </div>
          <div class="col-md-6">
            <label>Verify Password</label>
            <input type="password" class="form-control" id="verify_password">
          </div>
        </div>
      </div>
      <div class='alert alert-danger edit-password-error error' role='alert'>
      </div>
      <div class="text-center">
        <img src="/img/loading.gif" alt="" height="30px" class="loading mx-auto loading-edit-password">
        <button class="btn btn-outline-info mr-sm-3 btn-edit-password" type="button" disabled>Change Password</button>
        <button class="btn btn-outline-danger btn-cancel" type="reset" disabled>Cancel</button>
      </div>
    </form>
    <hr class="my-5">
    <h1>Deactivate Account</h1>
    <p class="text-muted">This will delete all of your posts and comments.</p>
    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> This action is irreversible. The deleted data will NOT be retrieved.</p>
    <div class="text-center">
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deactivate-confirmation">Deactive Account</button>

      <div class="modal fade" id="deactivate-confirmation" tabIndex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Deactivation</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <h3>Are You Sure?</h3>
              <p>This will delete all posts and comments you wrote.</p>
              <p class="text-danger">This action is irreversible.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger btn-delete-user">Deactive My Account</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
