  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Control</b>Personal</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              {{-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> --}}
              <img src="{{asset('img/avatar/'.auth()->user()->avatar.'.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth()->user()->login}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('img/avatar/'.auth()->user()->avatar).'.jpg'}}" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->nombre}}
                  {{-- <small>Member since Nov. 2012</small> --}}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <form method="post" action="{{route('logout')}}">
                    {{csrf_field()}}
                    <button class="btn btn-default btn-flat">Salir</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>