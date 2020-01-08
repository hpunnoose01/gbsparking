<?php
  if(isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
  } else {
    exit("404 Not Found");
  }
  $query = "SELECT * FROM `$posts` WHERE id=$post_id";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  if(!$row) {
    exit("Post does not exist!");
  }
  extract($row);

  $datetime = new DateTime($timestamp);
  $datetime_modified = new DateTime($last_modified);
  $datetime->setTimezone($timezone);
  $datetime_modified->setTimezone($timezone);

  $image_query = "SELECT * FROM `$images` WHERE post_id=$post_id ORDER BY id DESC";
  $image_result = mysqli_query($db, $image_query);

  function renderBtn() {
    global $author, $post_id;
    if ($_SESSION['username']===$author) {
      echo "<div class='col-10 text-right'>
        <a class='btn btn-outline-success' href='/edit-post/$post_id'>Edit Post</a>
        <button class='btn btn-outline-danger' type='button' data-toggle='modal' data-target='#delete-confirmation'>Delete Post</button>
        <div class='modal fade' id='delete-confirmation' tabIndex='-1' role='dialog'>
          <div class='modal-dialog' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title text-danger'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Delete Post</h5>
                <button type='button' class='close' data-dismiss='modal'>
                  <span>&times;</span>
                </button>
              </div>
              <div class='modal-body text-center'>
                <h3>Are You Sure?</h3>
                <p>This will delete all comments belong to this post as well.</p>
                <p class='text-danger'>This action is irreversible.</p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                <button type='button' class='btn btn-danger btn-delete-post' data-id=$post_id data-dismiss='modal' data-location='market'>Delete Post</button>
              </div>
            </div>
          </div>
        </div>
      </div>";
    }
  }

  $like_query = "SELECT * FROM `$votes` WHERE author = '$author' AND vote = 'upvote'";
  $like_result = mysqli_query($db, $like_query);
  $likes = mysqli_num_rows($like_result);
  if (!$likes) {
    $likes = 0;
  }
  $dislike_query = "SELECT * FROM `$votes` WHERE author = '$author' AND vote = 'downvote'";
  $dislike_result = mysqli_query($db, $dislike_query);
  $dislikes = mysqli_num_rows($dislike_result);
  if (!$dislikes) {
    $dislikes = 0;
  }
  $user_id = $_SESSION['id'];
  $liked_query = "SELECT * FROM `$votes` WHERE author='$author' AND vote='upvote' AND user_id='$user_id'";
  $liked_result = mysqli_query($db, $liked_query);
  $liked = mysqli_num_rows($liked_result);
  $disliked_query = "SELECT * FROM `$votes` WHERE author='$author' AND vote='downvote' AND user_id='$user_id'";
  $disliked_result = mysqli_query($db, $disliked_query);
  $disliked = mysqli_num_rows($disliked_result);

  $author_query = "SELECT * FROM `$users` WHERE username = '$author'";
  $author_result = mysqli_query($db, $author_query);
  $author_row = mysqli_fetch_assoc($author_result);
  $profileImage = $author_row['image'];
  if ($profileImage) {
    $profilePath = "$s3_path/user/$profileImage";
  } else {
    $profilePath = "/img/user/no_image.png";
  }

  function isBookmarked($user_id, $post_id) {
    global $db;
    global $bookmarks;
    $query = "SELECT * FROM `$bookmarks` WHERE user_id=$user_id AND post_id = $post_id";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result)) {
      $success = true;
    } else {
      $success = false;
    }
    return $success;
  }
?>

  <div class="row justify-content-between mb-3">
    <div class="col-2">
      <button class="btn btn-outline-info rounded-circle" onclick="window.history.go(-1);"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
    </div>
    <?php renderBtn(); ?>

  </div>
  <h1><?php echo htmlspecialchars($title); ?></h1>
  <p class="text-muted mb-1"><?php echo htmlspecialchars($cat); ?></p>
  <h6>Posted On: <span class="badge badge-pill badge-secondary ml-3"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $datetime->format('Y-m-d H:i:s'); ?></span></h6>
  <h6>Last Modified: <span class="badge badge-pill badge-info ml-3"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $datetime_modified->format('Y-m-d H:i:s'); ?></span></h6>

  <hr/>
  <div class="card-img-top image-wrapper post">
    <?php
    if($image_num=mysqli_num_rows($image_result)) {
      $i=$image_num;
      while($image_row=mysqli_fetch_assoc($image_result)) {
        $postImage = "$s3_path/post/".$image_row['image'];
    ?>
    <img class="img-fluid slides" id="slide<?php echo $i; ?>" src="<?php echo $postImage; ?>" alt="" style="height:auto;">
    <?php $i--; } ?>
    <?php } else { ?>
      <img class="img-fluid slides" id="slide1" src="/img/no-image-available.jpg" alt="" style="height:auto;">
    <?php } ?>
  </div>
  <div class="thumbnails">

  </div>
  <hr/>
  <div class="card-body">
    <div class="list-group">
      <div class="list-group-item bg-light">
        <h3>Description</h3>
      </div>
      <div class="list-group-item">
        <p class="card-text" style="white-space:pre-wrap; word-wrap:break-word;"><?= htmlspecialchars($content); ?></p>
      </div>
    </div>
    <table class="table table-bordered my-4">
      <tbody>
        <tr>
          <td class="w-25 bg-light"><strong>Location</strong></td>
          <td><p class="card-text"><?php echo htmlspecialchars("$city, $state"); ?></p></td>
        </tr>
        <tr>
          <td class="w-25 bg-light"><strong>Price</strong></td>
          <td><p class="card-text">$ <?php echo htmlspecialchars($price); ?></p></td>
        </tr>
      </tbody>
    </table>
    <?php if(isset($_SESSION['loggedIn'])) { ?>
    <div class="row">
      <div class="col text-center">

        <?php if(isBookmarked($_SESSION['id'], $post_id)) { ?>
          <button class="btn btn-outline-danger btn-bookmark" data-id="<?php echo $post_id; ?>"><i class="fa fa-times-circle"></i> Remove from Bookmarks</button>
        <?php } else { ?>
          <button class="btn btn-outline-warning btn-bookmark" data-id="<?php echo $post_id; ?>"><i class="fa fa-star"></i> Add to Bookmarks</button>
        <?php } ?>

      </div>
    </div>
  <?php } ?>
    <div class="row mt-3">
      <div class="col text-center">
        <p class="lead">Rate this seller</p>
        <div class="image-wrapper">
          <img src="<?php echo $profilePath; ?>" alt="" class="img-fluid" style="max-height:150px">
        </div>
        <p id="author"><?php echo $author; ?></p>
      </div>
      <div class="w-100">
      </div>
      <div class="col text-right">
        <button class="btn rounded-circle btn-rating <?php if($liked) {echo 'btn-primary'; } else { echo 'btn-outline-primary';}?>" id="upvote" <?php if(!$_SESSION['loggedIn']) {echo "disabled";} ?>><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
      </div>
      <div class="col text-left">
        <button class="btn rounded-circle btn-rating <?php if($disliked) {echo 'btn-primary'; } else { echo 'btn-outline-primary';}?>" id="downvote" <?php if(!$_SESSION['loggedIn']) {echo "disabled";} ?>><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
      </div>
    </div>
    <div class="row">
      <div class="col px-4 text-right">
        <p>+ <?php echo $likes; ?></p>
      </div>
      <div class="col px-4 text-left">
        <p>- <?php echo $dislikes; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col text-right">
        <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo $root.'post/'.$post_id; ?>&layout=button_count&size=small&mobile_iframe=false&width=69&height=20&appId" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>

      </div>
    </div>
  </div>


  <?php include("inc/modules/comments.php"); ?>
