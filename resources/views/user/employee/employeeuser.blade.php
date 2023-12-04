@extends('adminlte::page')

@section('title', 'Employee')
@include('layouts.css')
@section('content_header')
<h1>Employee</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th class="text-left">First Name</th>
                        <th class="text-left">Last Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Phone</th>
                        <th class="text-left">Company Name</th>
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
            ajax: "{{ route('employee.view_user') }}",
            columns: [
                {
                    data: 'first_nm',
                    name: 'first_nm'
                },
                {
                    data: 'last_nm',
                    name: 'last_nm',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'phone',
                    name: 'phone',
                },
                {
                    data: 'company_name',
                    name: 'company',
                    orderable: false,

                }
            ]
            
        });
    </script>
@stop
