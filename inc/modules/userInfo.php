<?php

if(isset($_SESSION['loggedIn'])) {
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

  $likes_query = "SELECT * FROM `$votes` WHERE author='$username' AND vote='upvote'";
  $likes_result = mysqli_query($db, $likes_query);
  $likes = mysqli_num_rows($likes_result);
  if (!$likes) {
    $likes = 0;
  }
  $dislikes_query = "SELECT * FROM `$votes` WHERE author='$username' AND vote='downvote'";
  $dislikes_result = mysqli_query($db, $dislikes_query);
  $dislikes = mysqli_num_rows($dislikes_result);
  if (!$dislikes) {
    $dislikes = 0;
  }
}

?>

<?php if(isset($_SESSION['loggedIn'])) { ?>
  <?php if(!$image) { ?>
    <div class="alert alert-info py-1 mb-1">
      Click <a href="/my-profile">Here</a> to set a profile picture!
    </div>
  <?php } ?>
  <div class="row">
    <div class="col-4 text-center">
      <div class="image-wrapper user-info">
        <a href="/my-profile">
          <img class="my-auto img-fluid" src="<?php echo $imagePath; ?>" alt="Generic placeholder image">
        </a>
      </div>
    </div>
    <div class="col-8">
      <div>
        <h5 class="mt-0"><a href="/my-profile"><?php echo htmlspecialchars($_SESSION["username"]); ?></a></h5>
        <p><?php echo htmlspecialchars($_SESSION["firstname"])." ".htmlspecialchars($_SESSION["lastname"]); ?></p>
        <p><i class="fa fa-thumbs-up text-primary"></i> <?php echo $likes; ?> &nbsp;<i class="fa fa-thumbs-down text-danger"></i> <?php echo $dislikes; ?></p>

      </div>
    </div>
    <div class="w-100 mt-1">
    </div>
    <div class="col-6">
      <a href="/add-post"><button type="button" class="btn btn-outline-success">
        <i class="fa fa-plus" aria-hidden="true"></i> Upload an Item</button></a>
    </div>
    <div class="col-6">
      <form method="post">
        <button class="btn btn-danger h-100 w-100" type="submit" name="sign-out">Sign Out <i class="fa fa-sign-out" aria-hidden="true"></i></button>
        <?php if(isset($_POST['sign-out'])) {session_destroy(); header("Location: /");}?>
      </form>
    </div>
  </div>

<?php } else { ?>

  <div>
    <p><i class="fa fa-user-times" aria-hidden="true"></i> You are not logged in</p>
    <p>Sign in to enjoy full features of Marketplace!</p>
    <a href="/" class="btn btn-primary d-block w-100">Sign In <i class="fa fa-sign-in" aria-hidden="true"></i></a>
    <p>or <a href="/sign-up" class="d-inline-block mx-auto mt-2">Sign Up</a> with Marketplace for free</p>
  </div>

<?php } ?>
