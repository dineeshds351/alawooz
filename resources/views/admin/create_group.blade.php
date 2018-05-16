@extends ('layouts.app')

@section ('header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Age Groups
        <small>Age groups for students </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Create Groups</li>
    </ol>
</section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create Age Group</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form role="form" method="POST" id="create_group">
                        {{ csrf_field() }}
                        {{ $age_group ? method_field('PATCH') : '' }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('group_name') ? ' has-error' : '' }}">
                                    <label for="title">Group Name</label>
                                    <input id="title" type="text" class="form-control" name="group_name" value="{{ old('group_name', isset($age_group->group_name) ? $age_group->group_name : '') }}" autofocus>
                                    @if ($errors->has('group_name'))
                                        <span class="help-block">{{ $errors->first('group_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('age_from') ? ' has-error' : '' }}">
                                    <label for="title">Age From</label>
                                    <input id="age_from" type="number" class="form-control age" name="age_from" value="{{ old('age_from', isset($age_group->age_from) ? $age_group->age_from : '') }}" autofocus>
                                    @if ($errors->has('age_from'))
                                        <span class="help-block">{{ $errors->first('age_from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('age_to') ? ' has-error' : '' }}">
                                    <label for="title">Age To</label>
                                    <input id="age_to" type="number" class="form-control age" name="age_to" value="{{ old('age_to', isset($age_group->age_to) ? $age_group->age_to : '') }}" autofocus>
                                    @if ($errors->has('age_to'))
                                        <span class="help-block">{{ $errors->first('age_to') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="save_group">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="overlay" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection

@push('script')
<script>

</script>
@endpush

