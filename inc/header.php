<nav class="bg-warning">
  <p class="text-center mb-0">This site is under development process, and all items on sale are for test-purpose only.</p>
</nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-md-0">
      <div class="container">
        <h1 class="navbar-brand"><a href="/home" style="color:inherit;">Marketplace 4989</a></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-controls="mobile-navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mobile-navbar">
          <div class="card p-3 mb-3 d-lg-none mt-3">

            <?php require("modules/userInfo.php"); ?>

          </div>
          <div class="card p-3 mb-3 d-lg-none mt-3">

            <?php require("modules/searchbar.php"); ?>

          </div>

          <?php if(isset($_SESSION['loggedIn'])) { ?>

            <div class="card p-3 mb-3 d-lg-none mt-3">
              <a href="/my-bookmarks"><i class="fa fa-bookmark" aria-hidden="true"></i> My Bookmarks</a>
            </div>

          <?php } ?>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item py-2">
              <a class="nav-link <?php if($_GET['page']==='home') {echo 'active';} ?>" href="/home">Home</a>
            </li>
            <li class="nav-item py-2">
              <a class="nav-link <?php if($_GET['page']==='about') {echo 'active';} ?>" href="/about">About</a>
            </li>
            <li class="nav-item dropdown py-2">
              <a class="nav-link <?php if($_GET['page']==='sales' || $_GET['page']==='add-post') {echo 'active';} ?>" href="/sales/All+Categories">Sales</a>
              <div class="dropdown-menu mt-0 py-0">
                <div class="row no-gutters">
                  <div class="col-6">
                    <a class="dropdown-item <?php if($_GET['cat']==='Health And Beauty') {echo 'active';}?>" href="/sales/Health+And+Beauty">Health & Beauty</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Clothing') {echo 'active';}?>" href="/sales/Clothing">Clothing</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Accessaries') {echo 'active';}?>" href="/sales/Accessaries">Accessaries</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Furniture') {echo 'active';}?>" href="/sales/Furniture">Furniture</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Appliances') {echo 'active';}?>" href="/sales/Appliances">Appliances</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Electronics') {echo 'active';}?>" href="/sales/Electronics">Electronics</a>
                  </div>
                  <div class="col-6">
                    <a class="dropdown-item <?php if($_GET['cat']==='Books') {echo 'active';}?>" href="/sales/Books">Books</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Entertainment') {echo 'active';}?>" href="/sales/Entertainment">Entertainment</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Pet Supplies') {echo 'active';}?>" href="/sales/Pet+Supplies">Pet Supplies</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Kids And Babies') {echo 'active';}?>" href="/sales/Kids+And+Babies">Kids & Babies</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Sports') {echo 'active';}?>" href="/sales/Sports">Sports</a>
                    <a class="dropdown-item <?php if($_GET['cat']==='Automotive') {echo 'active';}?>" href="/sales/Automotive">Automotive</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
