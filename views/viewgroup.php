<?php /* views/viewgroup.php */ ?>
<div class="flex-shrink-0 p-3 bg-white">
<!-- <img src="images/logo.png" class="bi me-2" width="30" height="30" /> -->
<span class="fs-5 fw-semibold"><i class="bi bi-bookmark-star-fill"></i> Favorites</span><br /><br />
<div class="list-group w-auto">
<?php
    foreach($params['bookmarks'] as $key):
?>    
  <a href="<?= $key['url'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true" target="_blank">
  <h3 class="bi bi-link"></h3>
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h6 class="mb-0"><?= $key['name'] ?></h6>
        <p class="mb-0 opacity-75"><?= $key['description'] ?></p>
      </div>
    </div>
  </a>
<?php
    endforeach;
?>  
</div>
</div>