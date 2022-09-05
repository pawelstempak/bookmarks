<?php /* views/grouplist.php */ ?>
<div class="flex-shrink-0 p-3 bg-white">
<div class="d-flex align-items-center pb-3 mb-3 border-bottom">
  <div class="flex-fill"><span class="fs-6 fw-semibold">Groups</span></div>
  <div class="flex-fill text-end"><a href="newgroup" class="btn btn-primary btn-sml">Add group</a></div>
</div>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($params['groupslist'] as $key):
    ?>
    <tr>
      <td><?php echo $key['name'] ?></td>
      <td class="text-end">
        <a href="/editgroup/<?php echo $key['id'] ?>" class="btn btn-secondary btn-sml">Edit</a> 
        <a href="#" class="btn btn-danger btn-sml" data-bs-toggle="modal" data-bs-target="#deletegroup<?php echo $key['id'] ?>Modal">Delete</a>
        <div class="modal fade" id="deletegroup<?php echo $key['id'] ?>Modal" tabindex="-1" aria-labelledby="deletegroupModal<?php echo $key['id'] ?>Label" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deletegroupModal<?php echo $key['id'] ?>Label">Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete it?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="/groupslist/<?php echo $key['id'] ?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>        
      </td>
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
</div>