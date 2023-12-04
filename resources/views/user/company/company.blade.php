@extends('adminlte::page')

@section('title', 'Company')
<link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/af-2.3.7/b-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.0.1/datatables.min.css" />
  <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
@section('content_header')
<h1>Company</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            @if(Auth::user()->role == "admin")
                <div class="col-6">
                    <button id="create-new-company" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Add New</button>
                </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Address</th>
                        @if(Auth::user()->role == "admin")
                        <th width="15%" colspan="2">Action</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@includeIf('user.company.deleteform')
@includeIf('user.company.form')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<script>
        //seting header csrf token laravel untuk semua request ajax 
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        //membuat datatables
        var table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            lengthChange: true,
            processing: true,
            serverSide: true,
            dom: 'Blfrtip',
            buttons: [
              'excel', 'pdf'
            ],
            //mengambil data dengan category controller
            ajax: "{{ route('company.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'address',
                    name: 'address',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        
        //close modal
        $('.close-btn').click(function(e) {
            $('.modal').modal('hide')
        });

        //save data untuk edit atau create
        $('#saveBtn').click(function(e) {
            var formdata = $("#modal-form form").serializeArray();
            var data = {};
            $(formdata).each(function(index, obj) {
                data[obj.name] = obj.value;
            });
            if (validation(data)) {
                $.ajax({
                    data: $('#modal-form form').serialize(),
                    url: "{{ route('company.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-form').modal('hide');
                        $('.table').DataTable().draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $.each(data.responseJSON.errors, function (key, item) 
                        {
                          $("#errors_company").append("<li class='alert alert-danger'>"+item+"</li>")
                        });
                        $('#saveBtn').html('Save Changes');
                    }
                });
            }

        });

        //delete data
        $('#deleteBtn').click(function(e) {
            var id = $("#id").val();
            console.log(id);
            $.ajax({
                type: "DELETE",
                url: 'company/'+ id,
                success: function(data) {
                    $('#modal-delete-form').modal('hide');
                    $('.table').DataTable().draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });


        //memunculkan form delete
        $('body').on('click', '.deleteCompany', function() {
            var id = $(this).data('id');
            $.get('company/' + id +'/edit', function (data) {
                $('.modal-title').text('Delete Company');
                $("#modal-delete-form").modal('show');
                $('#id').val(data.id);
            })
        });
      
        //memunculkan form add
        $('#create-new-company').click(function () {
            $("#modal-form").modal('show');
            $('#id').val('');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Company');
            $('#modal-form [name=name]').focus();
        });

        $('body').on('click', '.editCompany', function() {
            var id = $(this).data('id');
            $.get('company/' + id +'/edit', function(data) {
                $('.modal-title').text('Edit Company');
                $('#modal-form').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.address);
            })
        });

        //validasi name harus di isi
        function validation(data) {
            let formIsValid = true;
            $('span[id^="error"]').text('');
            if (!data.name) {
                formIsValid = false;
                $("#error-name").text('The name field is required.')
            }
            return formIsValid;
        }

        function submitHandler() {
            $('#saveBtn').click();
        }
    </script>
@stop