	<!-- Delete Modal HTML -->
      
    <div id="modal-delete-employee-form" class="modal fade"  data-backdrop="static">
          <div id="modal-dialog" class="modal-dialog">
            <div class="modal-content">
            <form id="userForm" name="userForm" class="form-horizontal" method="post">
                @method('DELETE')
                {{csrf_field()}}
                <div class="modal-header">
                  <h4 class="modal-title">Delete Data</h4>
                  <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete these Records ?</p>
                
                 
                </div>
                <div class="modal-footer">
                  
                  <button type="button" class="btn btn-sm btn-flat btn-primary" id="deleteBtn"><i
                            class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning close-btn" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left"></i> Cancel</button>
                </div>
              </form>
            </div>
          </div>
          </div>