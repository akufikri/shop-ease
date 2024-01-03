   <aside class="main-sidebar">
       <section class="sidebar">
           <!-- Sidebar user panel -->
           <div class="user-panel">
               <div class="pull-left image">
                   <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
               </div>
               <div class="pull-left info">
                   <p style="text-transform: uppercase">{{ Auth::user()->name }}</p>
                   <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
               </div>
           </div>
           <!-- search form -->
           <form action="#" method="get" class="sidebar-form">
               <div class="input-group">
                   <input type="text" name="q" class="form-control" placeholder="Search...">
                   <span class="input-group-btn">
                       <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                           <i class="fa fa-search"></i>
                       </button>
                   </span>
               </div>
           </form>
           <!-- /.search form -->
           <!-- sidebar menu: : style can be found in sidebar.less -->
           <ul class="sidebar-menu" data-widget="tree">
               <li class="header">MAIN NAVIGATION</li>
               <li>
                   <a href="/dashboard">
                       <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                   </a>
               </li>
               <li>
                   <a href="/kategori">
                       <i class="fa fa-archive"></i> <span>Kategori</span>
                   </a>
               </li>
               <li>
                   <a href="/produk">
                       <i class="fa fa-cubes"></i> <span>Produk</span>
                   </a>
               </li>

               <li class="treeview">
                   <a href="#">
                       <i class="fa fa-gears"></i> <span>Settings</span>
                       <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                       </span>
                   </a>
                   <ul class="treeview-menu">
                       <li><a href="#"><i class="fa fa-hourglass-2"></i> History</a></li>
                       <li class="treeview">
                           <a href="#"><i class="fa fa-user-plus"></i> Account
                               <span class="pull-right-container">
                                   <i class="fa fa-angle-left pull-right"></i>
                               </span>
                           </a>
                           <ul class="treeview-menu">
                               <li><a href="#"><i class="fa fa-user"></i> Users</a></li>
                               <li><a href="#"><i class="fa fa-user-secret"></i> Admin</a></li>
                           </ul>
                       </li>
                       <li><a href="/admin/role"><i class="fa fa-lock"></i> Role Auth</a></li>
                   </ul>
               </li>
           </ul>
       </section>
       <!-- /.sidebar -->
   </aside>
