<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>My Comments</h1>
    <hr class="my-2"/>
    <div class="table-responsive-md">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Comment</th>
            <th>Timestamp</th>
            <th>Post</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php require('inc/modules/myCommentsTable.php'); ?>
          
        </tbody>
      </table>
    </div>

  </div>

  <div class="modal fade" id="delete-confirmation" tabIndex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Delete Comment</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <h3>Are You Sure?</h3>
          <p>This will delete this comment completely.</p>
          <p class="text-danger">This action is irreversible.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger btn-delete-comment" data-dismiss="modal">Delete Comment</button>
        </div>
      </div>
    </div>
  </div>

</div>
