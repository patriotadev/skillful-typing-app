       <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('/images/typing.png') }}" alt="Skillful Typing Logo" class="brand-image img-circle elevation-3">
      <span class="title ml-2 brand-text font-weight-light">Skillful -- Typing</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/user2.png') }}" class="elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ session('user_name') }}</a>
        </div>
      </div> --}}
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          {{-- Login Admin --}}

          @if (session('hasLogin'))
            @if (session('user_roles') == 'Admin')
            <li class="nav-item">
              <a href="/admin/courses" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Lesson Editor
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/class" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                  Student Static
                </p>
              </a>
            <li class="nav-item">
              <a href="/admin/users" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Users Management
                </p>
              </a>
            </li>

            @else

            {{-- Login Student --}}
            <li class="nav-item">
              <a href="/student/lessons" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Current Lesson
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/student/tests" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Current Test
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/student/statics" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                  Student Static
                </p>
              </a>
            </li>
            @endif

          @else
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Current Lesson
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <style>
    .title {
      font-family: 'Water Brush', cursive;
    }
  </style>

