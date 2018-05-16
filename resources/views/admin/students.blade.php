@extends ('layouts.app')

@section ('header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>Users who registered </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Students</li>
    </ol>
</section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">List of Students</h3>
            
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="overlay" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection

@push('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  
@endpush

@push('js')

<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- Handlebars -->
<script src="{{ asset('plugins/handlebars/handlebars.min.js') }}"></script>
<!-- Bootstrap Confirmation -->
<script src="{{ asset('plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}"></script> 
@endpush

@push('script')

<!-- page script -->
<script>
    $(function () {
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('students.data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
                
                
            ],
            "fnDrawCallback": function (oSettings) {
                $('[data-toggle=delete]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    onConfirm: function() {
                        $.ajax({
                            url: $(this).data('url'), 
                            data: {
                                "_token" : "{{ csrf_token() }}"
                            },
                            type: 'DELETE',
                            success: function(result) {
                                if(result) {
                                    $('#table').DataTable().ajax.reload();
                                }
                                Alert.show(result.message,result.type);
                            },
                            beforeSend: function(){
                                $(".overlay").show();
                            },
                            complete: function(){
                                $(".overlay").hide();
                            }
                        });
                    }
                });
                $('[data-toggle=disable]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    onConfirm: function() {
                        $.ajax({
                            url: $(this).data('url'), 
                            data: {
                                "_token" : "{{ csrf_token() }}"
                            },
                            type: 'PATCH',
                            success: function(result) {
                                if(result) {
                                    $('#table').DataTable().ajax.reload();
                                }
                                Alert.show(result.message,result.type);
                            },
                            beforeSend: function(){
                                $(".overlay").show();
                            },
                            complete: function(){
                                $(".overlay").hide();
                            }
                        });
                    }
                });
            }
        });
    });
</script>
  
@endpush