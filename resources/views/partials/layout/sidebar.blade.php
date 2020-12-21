  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/avatar/{{auth()->user()->avatar}}.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->login}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="{{!Route::is('home') ?: 'active'}}"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
        <li class="header">PERSONAL</li>
        <li class="{{!Route::is('contratos.index') ?: 'active'}}">
          <a href="{{route('contratos.index')}}"><i class="fa fa-file-text-o"></i> <span>Lista de contratos</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>