@extends('layouts.app')

@section ('header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Sprightly</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Dashboard</h3>
        </div>
        <div class="box-body">
            You are logged in!
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection