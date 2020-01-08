<?php


  // base
  if(!isset($cat)) {
    $cat = '';
  }
  if($cat === "All Categories" && $cat) {
    $whereClause = "";
  } else if($cat) {
    $whereClause = " WHERE cat = '$cat'";
  } else if($q) {
    $whereClause = " WHERE (title LIKE '%$q%' OR content LIKE '%$q%')";
  } else {
    $whereClause ="";
  }
  $orderClause = " ORDER BY timestamp DESC";

  // filter
  $order = '';
  if(isset($_GET['sort-by'])) {

    $order = $_GET['sort-by'];
    $min = $_GET['min'];
    $max = $_GET['max'];

    switch($order) {
      case "newest":
        $orderClause = " ORDER BY timestamp DESC";
        break;
      case "cheapest":
        $orderClause = " ORDER BY price ASC";
        break;
      case "rating":
        // $rating_query = "SELECT votes.author, COUNT(*) FROM `$votes` WHERE vote='upvote' GROUP BY votes.author";
        // $rating_result = mysqli_query($db, $rating_query) or die(mysqli_error($db));
        // while ($rating_row=mysqli_fetch_assoc($rating_result)) {
        //   $vote_author = $rating_row['author'];
        //   $count = $rating_row['COUNT(*)'];
        //   $update_query = "UPDATE `$posts` SET author_rating = $count WHERE author = '$vote_author'";
        //   mysqli_query($db, $update_query);
        // }
        $orderClause = " ORDER BY author_rating DESC, timestamp DESC";
        break;
    }

    if ($min !== "" || $max !== "") {
      if ($min !== "" && $max !== "") {
        $range = " price BETWEEN $min AND $max";
      } else if ($min !== "") {
        $range = " price >= $min";
      } else if ($max !== "") {
        $range = " price <= $max";
      }
      if ($whereClause === "") {
        $whereClause .= " WHERE".$range;
      } else {
        $whereClause .= " AND".$range;
      }
    }

  }

  // pagination
  $query = "SELECT * FROM `$posts`".$whereClause.$orderClause;
  $result = mysqli_query($db, $query);
  $post_num = mysqli_num_rows($result);
  $post_per_page = 6;
  $page_num = ceil($post_num/$post_per_page);
  $first_of_page = $post_per_page*($p-1);

  // result by pages
  $query = "SELECT * FROM `$posts`".$whereClause.$orderClause." LIMIT $first_of_page, $post_per_page";
  $result = mysqli_query($db, $query);

?>

<form method="GET">
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label>Sort by</label>
        <select class="form-control" name="sort-by">
          <option value="newest" <?php if($order==="newest") {echo "selected";}?>>Newest</option>
          <option value="cheapest" <?php if($order==="cheapest") {echo "selected";}?>>Cheapest</option>
          <option value="rating" <?php if($order==="rating") {echo "selected";}?>>Seller's Rating</option>
        </select>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="form-group">
        <label>Price range</label>
        <div class="row">
          <div class="col">
            <div class="icon-input">
              <i class="fa fa-dollar"></i>
              <input type="number" min="0" step="0.01" name="min" class="form-control" onfocus="this.select();" value="<?php echo $min; ?>">
            </div>
          </div>
          &mdash;
          <div class="col">
            <div class="icon-input">
              <i class="fa fa-dollar"></i>
              <input type="number" min="0" step="0.01" name="max" class="form-control" onfocus="this.select();" value="<?php echo $max; ?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <label>Distance (not implemented yet)</label>
      <div class="row no-gutters">
        <div class="col">
          <input type="number" name="distance" value="" placeholder="miles from" class="form-control">
        </div>
        <div class="col">
          <input type="number" name="zipcode" value="" placeholder="zip" class="form-control" max="99999">
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Location (not implemented yet)</label>
        <div class="row">
          <div class="col">
            <input type="text" name="city" value="" placeholder="City" class="form-control">
          </div>
          <div class="col">
            <select class="form-control" name="state">
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
    </div>
  </div>
  <div class="row justify-content-center">
    <button type="submit" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
  </div>
</form>

<?php
if(isset($_GET['sort-by']) && $p > $page_num) {
  if($page == 'search') {
    $q = str_replace(" ", "+", $q);
    $url_tmp = $q;
  } else if ($page == 'sales') {
    $cat = str_replace(" ", "+", $cat);
    $url_tmp = $cat;
  }

  $filter_param = $_SERVER['REQUEST_URI'];
  $get_position = strpos($filter_param, '?');
  $filter_param = substr($filter_param, $get_position);

  header("Location: /$page/$url_tmp/1$filter_param");
}
?>
