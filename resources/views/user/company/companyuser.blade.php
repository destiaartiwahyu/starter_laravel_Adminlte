@extends('adminlte::page')

@section('title', 'Company')
@include('layouts.css')
@section('content_header')
<h1>Company</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
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
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@include('layouts.script')
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
            ajax: "{{ route('company.view_user') }}",
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
            ]
        });
    </script>
@stop
