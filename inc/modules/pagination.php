<?php
if($page == 'search') {
  $q = str_replace(" ", "+", $q);
  $url_tmp = $q;
} else if ($page == 'sales') {
  $cat = str_replace(" ", "+", $cat);
  $url_tmp = $cat;
}

if (isset($_GET['sort-by'])) {
  $filter_param = $_SERVER['REQUEST_URI'];
  $get_position = strpos($filter_param, '?');
  $filter_param = substr($filter_param, $get_position);
} else {
  $filter_param = "";
}

?>

<div class="row justify-content-center">
  <nav aria-label="...">
    <ul class="pagination pagination-md">
      <?php for($i=1; $i<=$page_num; $i++) { ?>
      <li class="page-item <?php if($i==$p) {echo 'disabled';} ?>"><a class="page-link" href="<?php echo '/'.$page.'/'.$url_tmp.'/'.$i.$filter_param; ?>"><?php echo $i; ?></a></li>
      <?php } ?>
    </ul>
  </nav>
</div>
