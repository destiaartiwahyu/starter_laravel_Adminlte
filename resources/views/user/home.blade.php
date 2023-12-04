@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this admin panel.</p>

    <div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3>{{$company_count}}</h3>
<p>Company</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="/company" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3>{{$employee_count}}</h3>
<p>Employee</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="/employee" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
</div>


<div class="row mt-3 ml-1">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Last 5 Company</h3>
                                    <div class="card-tools">
                                    <a href="/employee" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped table-valign-middle">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($company as $list)
                                            <tr>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->address }}</td>
                                                <td>{{ $list->email }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Last 5 Employee</h3>
                                    <div class="card-tools">
                                    <a href="/company" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped table-valign-middle">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($employee as $list)
                                            <tr>
                                                <td>{{ $list->first_nm }} {{ $list->last_nm }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->phone }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop