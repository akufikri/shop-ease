  <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{ Auth::user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                          <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle"
                              alt="User Image">
                          <p>
                              {{ Auth::user()->name }}
                              {{-- <small>Member since Nov. 2012</small> --}}
                          </p>
                      </li>
                      <li class="user-footer">
                          <div class="pull-left">
                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                          </div>
                          <div class="pull-right">
                              <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
                          </div>
                      </li>
                  </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
          </ul>
      </div>

  </nav>
