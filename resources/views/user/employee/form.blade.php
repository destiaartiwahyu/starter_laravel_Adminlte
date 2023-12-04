<div class="modal fade" id="modal-employee-form" tabindex="-1" role="dialog" aria-labelledby="modal-employee-form">
    <div class="modal-dialog" role="document">
        <form onSubmit="JavaScript:submitHandler()"  action="javascript:void(0)" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <div class="form-group">
                        <label for="first_nm">First Name</label>
                        <input type="text" name="first_nm" id="first_nm" class="form-control" required autofocus>
                        <span class="text-danger" id="error-first-name"></span>
                    </div>
                    <div class="form-group">
                        <label for="last_nm">Last Name</label>
                        <input type="text" name="last_nm" id="last_nm" class="form-control" required autofocus>
                        <span class="text-danger" id="error-last-name"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required autofocus>
                        <span class="text-danger" id="error-email"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required autofocus>
                        <span class="text-danger" id="error-phone"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Company</label>
                        <select class="form-control " id="company_id" name="company_id" required>
                       @foreach($company as $company)         
                          <option value="{{ $company->id}}"  >{{ $company->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div id="errors"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-flat btn-primary" id="saveBtn"><i
                            class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning close-btn" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>