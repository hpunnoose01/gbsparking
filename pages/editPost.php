<?php


  $post_id = $_GET['post_id'];

  $query = "SELECT * FROM `$posts` WHERE id=$post_id";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  if (!$row) {
    die("Post does not exist!");
  }
  extract($row);

  $image_query = "SELECT * FROM `$images` WHERE post_id=$post_id";
  $image_result = mysqli_query($db, $image_query);
  $image_num = mysqli_num_rows($image_result);

?>

  <div class="jumbotron jumbotron-fluid py-4 px-3">
    <form id="edit-post-form" method="POST">
      <div class="form-group">
        <label>Title</label>
        <input name="title" type="text" id="title" class="form-control" value="<?php echo $title; ?>" maxlength="30">
      </div>
      <div class="form-group">
        <label>Category</label>
        <select class="form-control" id="category" name="category">
          <option value="Health And Beauty" <?php if($cat==="Health And Beauty") {echo "selected";} ?>>Health & Beauty</option>
          <option value="Clothing" <?php if($cat==="Clothing") {echo "selected";} ?>>Clothing</option>
          <option value="Accessaries" <?php if($cat==="Accessaries") {echo "selected";} ?>>Accessaries</option>
          <option value="Furniture" <?php if($cat==="Furniture") {echo "selected";} ?>>Furniture</option>
          <option value="Appliances" <?php if($cat==="Appliances") {echo "selected";} ?>>Appliances</option>
          <option value="Electronics" <?php if($cat==="Electronics") {echo "selected";} ?>>Electronics</option>
          <option value="Books" <?php if($cat==="Books") {echo "selected";} ?>>Books</option>
          <option value="Entertainment" <?php if($cat==="Entertainment") {echo "selected";} ?>>Entertainment</option>
          <option value="Pets Supplies" <?php if($cat==="Pets Supplies") {echo "selected";} ?>>Pets Supplies</option>
          <option value="Kids And Babies" <?php if($cat==="Kids And Babies") {echo "selected";} ?>>Kids & Babies</option>
          <option value="Sports" <?php if($cat==="Sports") {echo "selected";} ?>>Sports</option>
          <option value="Automotive" <?php if($cat==="Automotive") {echo "selected";} ?>>Automotive</option>
        </select>
      </div>
      <div class="form-group">
        <label>Location</label>
        <div class="row">
          <div class="col">
            <input type="text" id="city" class="form-control" placeholder="City" value="<?php echo $city; ?>" name="city" maxlength="15">
          </div>
          <div class="col">
            <select id="state" class="form-control" name="state">
            	<option value="AL" <?php if($state==="AL") {echo "selected";} ?>>AL</option>
            	<option value="AK" <?php if($state==="AK") {echo "selected";} ?>>AK</option>
            	<option value="AR" <?php if($state==="AR") {echo "selected";} ?>>AR</option>
            	<option value="AZ" <?php if($state==="AZ") {echo "selected";} ?>>AZ</option>
            	<option value="CA" <?php if($state==="CA") {echo "selected";} ?>>CA</option>
            	<option value="CO" <?php if($state==="CO") {echo "selected";} ?>>CO</option>
            	<option value="CT" <?php if($state==="CT") {echo "selected";} ?>>CT</option>
            	<option value="DC" <?php if($state==="DC") {echo "selected";} ?>>DC</option>
            	<option value="DE" <?php if($state==="DE") {echo "selected";} ?>>DE</option>
            	<option value="FL" <?php if($state==="FL") {echo "selected";} ?>>FL</option>
            	<option value="GA" <?php if($state==="GA") {echo "selected";} ?>>GA</option>
            	<option value="HI" <?php if($state==="HI") {echo "selected";} ?>>HI</option>
            	<option value="IA" <?php if($state==="IA") {echo "selected";} ?>>IA</option>
            	<option value="ID" <?php if($state==="ID") {echo "selected";} ?>>ID</option>
            	<option value="IL" <?php if($state==="IL") {echo "selected";} ?>>IL</option>
            	<option value="IN" <?php if($state==="IN") {echo "selected";} ?>>IN</option>
            	<option value="KS" <?php if($state==="KS") {echo "selected";} ?>>KS</option>
            	<option value="KY" <?php if($state==="KY") {echo "selected";} ?>>KY</option>
            	<option value="LA" <?php if($state==="LA") {echo "selected";} ?>>LA</option>
            	<option value="MA" <?php if($state==="MA") {echo "selected";} ?>>MA</option>
            	<option value="MD" <?php if($state==="MD") {echo "selected";} ?>>MD</option>
            	<option value="ME" <?php if($state==="ME") {echo "selected";} ?>>ME</option>
            	<option value="MI" <?php if($state==="MI") {echo "selected";} ?>>MI</option>
            	<option value="MN" <?php if($state==="MN") {echo "selected";} ?>>MN</option>
            	<option value="MO" <?php if($state==="MO") {echo "selected";} ?>>MO</option>
            	<option value="MS" <?php if($state==="MS") {echo "selected";} ?>>MS</option>
            	<option value="MT" <?php if($state==="MT") {echo "selected";} ?>>MT</option>
            	<option value="NC" <?php if($state==="NC") {echo "selected";} ?>>NC</option>
            	<option value="NE" <?php if($state==="NE") {echo "selected";} ?>>NE</option>
            	<option value="NH" <?php if($state==="NH") {echo "selected";} ?>>NH</option>
            	<option value="NJ" <?php if($state==="NJ") {echo "selected";} ?>>NJ</option>
            	<option value="NM" <?php if($state==="NM") {echo "selected";} ?>>NM</option>
            	<option value="NV" <?php if($state==="NV") {echo "selected";} ?>>NV</option>
            	<option value="NY" <?php if($state==="NY") {echo "selected";} ?>>NY</option>
            	<option value="ND" <?php if($state==="ND") {echo "selected";} ?>>ND</option>
            	<option value="OH" <?php if($state==="OH") {echo "selected";} ?>>OH</option>
            	<option value="OK" <?php if($state==="OK") {echo "selected";} ?>>OK</option>
            	<option value="OR" <?php if($state==="OR") {echo "selected";} ?>>OR</option>
            	<option value="PA" <?php if($state==="PA") {echo "selected";} ?>>PA</option>
            	<option value="RI" <?php if($state==="RI") {echo "selected";} ?>>RI</option>
            	<option value="SC" <?php if($state==="SC") {echo "selected";} ?>>SC</option>
            	<option value="SD" <?php if($state==="SD") {echo "selected";} ?>>SD</option>
            	<option value="TN" <?php if($state==="TN") {echo "selected";} ?>>TN</option>
            	<option value="TX" <?php if($state==="TX") {echo "selected";} ?>>TX</option>
            	<option value="UT" <?php if($state==="UT") {echo "selected";} ?>>UT</option>
            	<option value="VT" <?php if($state==="VT") {echo "selected";} ?>>VT</option>
            	<option value="VA" <?php if($state==="VA") {echo "selected";} ?>>VA</option>
            	<option value="WA" <?php if($state==="WA") {echo "selected";} ?>>WA</option>
            	<option value="WI" <?php if($state==="WI") {echo "selected";} ?>>WI</option>
            	<option value="WV" <?php if($state==="WV") {echo "selected";} ?>>WV</option>
            	<option value="WY" <?php if($state==="WY") {echo "selected";} ?>>WY</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Price</label>
        <div class="icon-input">
          <i class="fa fa-dollar"></i>
          <input name="price" type="number" id="price" class="form-control" value="<?php echo $price; ?>" max="50000">
        </div>
      </div>
      <div class="form-group">
        <label>Description</label><p class="d-inline pull-right"><span class="content-limit">0</span>/500</p>
        <textarea class="form-control" style="height:150px; resize:none;" id="content" name="content" maxlength="500"><?php echo $content; ?></textarea>
      </div>
        <?php
          $i = 1;
          while($image_row = mysqli_fetch_assoc($image_result)) {
                  $image = $image_row['image'];
                  $postImage = "$s3_path/post/$image";

        ?>
        <div class="form-group">
          <div class="image-wrapper" style="height: 200px;">
            <img src="<?php echo $postImage; ?>" alt="" class="img-fluid post-preview" id="post-preview<?php echo $i; ?>">
          </div>
          <input hidden type="text" name="post-id[]" value="<?php echo $image; ?>">
          <p class="text-center"><i class="fa fa-trash delete-post-image" style="cursor:pointer;"></i></p>
        </div>
        <?php
          $i++;
         }
        ?>
      <div class="image-upload">

      </div>
      <div class="col text-center">
        <button type="button" class="btn btn-primary mb-2 btn-add-image">
          <i class="fa fa-plus-circle"></i> Add another image
        </button>
      </div>
      <input type="number" step="0.01" id="post_id" value="<?php echo $row['id']; ?>" hidden name="post_id">
      <div class="btn-grp text-center">
        <div class='alert alert-danger edit-post-error error' role='alert'></div>
        <img src="/img/loading.gif" alt="" height="30px" class="loading mx-auto">
        <button type="submit" class="btn btn-success btn-edit-post">Update</button>
        <button type="button" class="btn-cancel btn btn-secondary" onclick="window.history.go(-1);">Cancel</button>
      </div>
    </form>
  </div>
