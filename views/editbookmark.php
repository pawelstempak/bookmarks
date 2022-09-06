<?php /* views/editbookmark.php */ ?>
<div class="flex-shrink-0 p-3 bg-white">
<div class="d-flex align-items-center pb-3 mb-3 border-bottom">
<span class="fs-6 fw-semibold"><a class="link-secondary" href="groupslist">Bookmarks</a> <i class="bi bi-arrow-right-short"></i> Edit bookmark</span>
</div>
<h4>Edit bookmark</h4><br />
<form action="" method="post">
  <div class="mb-3">
    <label for="inputName" class="form-label">Bookmark name</label>
    <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" value="<?php echo $params['bookmark_one']['name'] ?>">
    <input type="hidden" name="id" value="<?php echo $params['bookmark_one']['id'] ?>">
    <div id="nameHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="form-select" class="form-label">Category</label>
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category">
    <?php foreach($params['groupslist'] as $key): ?>
    <option value="<?php echo $key['id'] ?>"><?php echo $key['name'] ?></option>
    <?php endforeach; ?>    
    </select>      
  </div>
  <div class="form-check form-switch pb-2">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" name="star"<?php if($params['bookmark_one']['star']==1) echo "checked"; ?>>
    <label class="form-label" for="flexSwitchCheckDefault">Favorites</label>
  </div>
  <div class="mb-3">
    <label for="inputUrl" class="form-label">Url</label>
    <input type="text" name="url" class="form-control" id="inputUrl" aria-describedby="nameHelp" value="<?php echo $params['bookmark_one']['url'] ?>">
    <div id="nameHelp" class="form-text"></div>
  </div>      
  <div class="mb-3">
    <label for="inputImportfield" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="inputImportfield"rows="10"><?php echo $params['bookmark_one']['description'] ?></textarea><br />
  <div class="d-flex justify-content-between"><button type="submit" class="btn btn-secondary">Save</button> <a href="/bookmarkslist" type="button" class="btn btn-light float-right">Cancel</a></div>
</form>
</div>