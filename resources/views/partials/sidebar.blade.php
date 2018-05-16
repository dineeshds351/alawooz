<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                 <img src="{{ get_profile_image(Auth::user()->image) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#">{{ Auth::user()->email }}</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('dashboard') }}"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @if(Auth::user()->hasRole('admin'))
                <li class="{{ set_active('students') }}"><a href="{{ url('/students') }}"><i class="fa fa-user"></i> <span>Students</span></a></li>
                <li class="{{ set_active('age.group') }}"><a href="{{ url('/age/group') }}"><i class="fa fa-group"></i> <span>Age Groups</span></a></li>
            @endif
           
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->