
<div class="sticky-top pt-3">
  <nav class="bg-light profile-sidebar">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['page']==='my-profile') {echo 'active';} ?>" href="/my-profile">
            <i class="fa fa-user" aria-hidden="true"></i> My Profile
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['page']==='my-posts') {echo 'active';} ?>" href="/my-posts">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i> My Items
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['page']==='my-comments') {echo 'active';} ?>" href="/my-comments">
            <i class="fa fa-comment" aria-hidden="true"></i> My Comments
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['page']==='my-bookmarks') {echo 'active';} ?>" href="/my-bookmarks">
            <i class="fa fa-bookmark" aria-hidden="true"></i> My Bookmarks
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['page']==='settings') {echo 'active';} ?>" href="/settings">
            <i class="fa fa-cog" aria-hidden="true"></i> Settings
          </a>
        </li>
      </ul>
  </nav>
</div>
