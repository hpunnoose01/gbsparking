<?php if(isset($_SESSION['loggedIn'])) { ?>

  <div class="jumbotron jumbotron-fluid py-4 px-3">
    <form id="add-post-form" method="POST">
      <div class="form-group">
        <label>Title</label>
        <input type="text" id="title" class="form-control" name="title" maxlength="30">
      </div>
      <div class="form-group">
        <label>Category</label>
        <select class="form-control" id="category" name="category">
          <option value="">Select a Category</option>
          <option value="Health And Beauty">Health & Beauty</option>
          <option value="Clothing">Clothing</option>
          <option value="Accessaries">Accessaries</option>
          <option value="Furniture">Furniture</option>
          <option value="Appliances">Appliances</option>
          <option value="Electronics">Electronics</option>
          <option value="Books">Books</option>
          <option value="Entertainment">Entertainment</option>
          <option value="Pets Supplies">Pets Supplies</option>
          <option value="Kids And Babies">Kids & Babies</option>
          <option value="Sports">Sports</option>
          <option value="Automotive">Automotive</option>
        </select>
      </div>
      <div class="form-group">
        <label>Location</label>
        <div class="row">
          <div class="col">
            <input type="text" id="city" class="form-control" placeholder="City" name="city" maxlength="15">
          </div>
          <div class="col">
            <select id="state" class="form-control" name="state">
              <option value="">State</option>
            	<option value="AL">AL</option>
            	<option value="AK">AK</option>
            	<option value="AR">AR</option>
            	<option value="AZ">AZ</option>
            	<option value="CA">CA</option>
            	<option value="CO">CO</option>
            	<option value="CT">CT</option>
            	<option value="DC">DC</option>
            	<option value="DE">DE</option>
            	<option value="FL">FL</option>
            	<option value="GA">GA</option>
            	<option value="HI">HI</option>
            	<option value="IA">IA</option>
            	<option value="ID">ID</option>
            	<option value="IL">IL</option>
            	<option value="IN">IN</option>
            	<option value="KS">KS</option>
            	<option value="KY">KY</option>
            	<option value="LA">LA</option>
            	<option value="MA">MA</option>
            	<option value="MD">MD</option>
            	<option value="ME">ME</option>
            	<option value="MI">MI</option>
            	<option value="MN">MN</option>
            	<option value="MO">MO</option>
            	<option value="MS">MS</option>
            	<option value="MT">MT</option>
            	<option value="NC">NC</option>
            	<option value="NE">NE</option>
            	<option value="NH">NH</option>
            	<option value="NJ">NJ</option>
            	<option value="NM">NM</option>
            	<option value="NV">NV</option>
            	<option value="NY">NY</option>
            	<option value="ND">ND</option>
            	<option value="OH">OH</option>
            	<option value="OK">OK</option>
            	<option value="OR">OR</option>
            	<option value="PA">PA</option>
            	<option value="RI">RI</option>
            	<option value="SC">SC</option>
            	<option value="SD">SD</option>
            	<option value="TN">TN</option>
            	<option value="TX">TX</option>
            	<option value="UT">UT</option>
            	<option value="VT">VT</option>
            	<option value="VA">VA</option>
            	<option value="WA">WA</option>
            	<option value="WI">WI</option>
            	<option value="WV">WV</option>
            	<option value="WY">WY</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Price</label>
        <div class="icon-input">
          <i class="fa fa-dollar"></i>
          <input type="number" step="0.01" id="price" class="form-control" name="price" max="50000" min="0">
        </div>
      </div>
      <div class="form-group">
        <label>Description</label><p class="d-inline pull-right"><span class="content-limit">0</span>/500</p>
        <textarea class="form-control" style="height:150px; resize:none;" id="content" name="content" maxlength="500"></textarea>
      </div>
      <div class="image-upload">
        <div class="form-group">
          <div class="image-wrapper" style="height: 200px;">
            <img src="/img/no-image-available.jpg" alt="" class="img-fluid post-preview" id="post-preview1">
          </div>
          <p class="text-center"><i class="fa fa-trash delete-post-image" style="cursor:pointer;"></i></p>
          <input type="file" name="file[]" id="post-image1" class="form-control post-image">
        </div>

      </div>
      <div class="col text-center">
        <button type="button" class="btn btn-primary mb-2 btn-add-image">
          <i class="fa fa-plus-circle"></i> Add another image
        </button>
      </div>
      <div class="btn-grp text-center">
        <div class='alert alert-danger add-post-error error' role='alert'></div>
        <img src="/img/loading.gif" alt="" height="30px" class="loading mx-auto">
        <button type="submit" class="btn btn-success btn-add-post">Upload</button>
        <button type="button" class="btn-cancel btn btn-secondary" onclick="window.history.go(-1);">Cancel</button>
      </div>
    </form>
  </div>

<?php } else { ?>

  <div class="container text-center py-5" style="background-color:rgba(0,0,0,0.75);">
    <h2 as="h2" style="color:white">
      Please <a href="/">Sign In</a> to upload a post.
    </h2>
    <p class="text-muted pt-4 pb-0 mb-0">Don't have an account yet?</p>
    <a href="/sign-up">Sign up for full features for free!</a>
  </div>

<?php } ?>
