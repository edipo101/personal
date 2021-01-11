  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('img/avatar/'.auth()->user()->avatar.'.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->login}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="{{!Route::is('home') ?: 'active'}}">
          <a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a>
        </li>
        <li class="header">PERSONAL</li>
        <li class="{{!Route::is('home') ?: 'active'}}">
          <a href="{{route('home')}}"><i class="fa fa-users"></i> <span>Personal con item</span></a>
        </li>
        <li class="{{!Route::is('funcionarios.lactancia') ?: 'active'}}">
          <a href="{{route('funcionarios.lactancia')}}"><i class="fa fa-users"></i> <span>Personal con lactancia</span></a>
        </li>
        <li class="{{!Route::is('funcionarios.codepedis') ?: 'active'}}">
          <a href="{{route('funcionarios.codepedis')}}"><i class="fa fa-users"></i> <span>Personal con Codepedis</span></a>
        </li>
        <li class="header">CONTRATOS</li>
        <li class="{{!Route::is('acontrato.index') ?: 'active'}}">
          <a href="{{route('acontrato.index')}}"><i class="fa fa-users"></i> <span>Personal a contrato</span></a>
        </li>
        <li class="{{!Route::is('contratos.index') ?: 'active'}}">
          <a href="{{route('contratos.index')}}"><i class="fa fa-file-text-o"></i> <span>Lista de contratos</span></a>
        </li>
        <li class="{{!Route::is('contratos.2021') ?: 'active'}}">
          <a href="{{route('contratos.2021')}}"><i class="fa fa-file-text-o"></i> <span>Contratos 2021</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Nuevo</small>
            </span>
          </a>
        </li>
        <li class="header">CONSULTORIAS</li>
        <li class="{{!Route::is('consultorias.index') ?: 'active'}}">
          <a href="{{route('consultorias.index')}}"><i class="fa fa-file-text-o"></i> <span>Lista de consultorias</span></a>
        </li>
        <li class="{{!Route::is('consultorias.index') ?: 'active'}}">
          <a href="{{route('consultorias.index')}}"><i class="fa fa-file-text-o"></i> <span>Consultorias 2021</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>