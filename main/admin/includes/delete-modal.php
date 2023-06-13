<!-- Modal -->
<div class="modal fade" id="staticBackdrop" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="staticBackdropLabel">Delete</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are are you sure you want to delete this?</p>
      </div>
      <div class="modal-footer">
        <form action="posts.php" method="post">
          <input type="hidden" class="modal_delete_link" name="delete-post" value="">
          <input class="btn btn-danger delete_link" type="submit" name="delete" value="Delete">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>