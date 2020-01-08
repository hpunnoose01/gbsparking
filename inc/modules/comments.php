
<div class="jumbotron jumbotron-fluid py-2 my-2">
  <div class="container">

    <?php if(isset($_SESSION['loggedIn'])) { ?>

    <div class="row align-items-center">
      <div class="col-3 text-center align-items-center d-flex justify-content-center flex-column">
        <img src="<?php echo $imagePath; ?>" alt="" class="img-fluid" style="max-height:150px">
        <h5 class="mt-0" id="username"><?php echo $_SESSION['username']; ?></h5>
      </div>
      <div class="col-9">
        <form id="comment-form">
          <div class="form-group">
            <label>Leave a Comment</label>
            <textarea class="form-control" style="resize: none; height:100px" id="comment"></textarea>
          </div>
          <input type="number" id="post_id" value="<?php echo $post_id; ?>" hidden>
          <img src="/img/loading.gif" alt="" height="30px" class="loading pull-right mr-4">
          <button type="button" class="btn btn-primary pull-right btn-add-comment" disabled>Submit</button>
        </form>
      </div>
    </div>

    <?php } else { ?>

    <div class="row justify-content-center mb-2">
      <div class="col-12">
        <div class="container text-center py-5" style="background-color:rgba(0,0,0,0.75);">
          <h2 style"color:white">
            Please <a href="/">Sign In</a> to leave a comment
          </h2>
          <p class="text-muted pt-2 pb-0 mb-0">Don't have an account yet?</p>
          <a href="/sign-up">Sign up for full features for free!</a>
        </div>
      </div>
    </div>

    <?php } ?>

    <?php include("commentList.php"); ?>

  </div>
</div>
