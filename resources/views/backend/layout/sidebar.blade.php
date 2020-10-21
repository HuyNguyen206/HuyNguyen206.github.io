<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin" class="brand-link">
        <img src="backend/adminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="backend/adminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="admin" class="d-block">{{Auth::user()->email}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @can('view', App\Category::class)
                <li class="nav-item">
                    <a href="admin/category/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách category
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\Menu::class)
                <li class="nav-item">
                    <a href="admin/menu/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách menu
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\Product::class)
                <li class="nav-item">
                    <a href="admin/product/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách sản phẩm
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\Slider::class)
                <li class="nav-item">
                    <a href="admin/slider/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách sliders
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\Setting::class)
                <li class="nav-item">
                    <a href="admin/setting/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Setting
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\User::class)
                <li class="nav-item">
                    <a href="admin/user/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\Role::class)
                <li class="nav-item">
                    <a href="admin/role/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                @endcan
                @can('view', App\Permission::class)
                <li class="nav-item">
                    <a href="admin/permission/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Permission
                        </p>
                    </a>
                </li>
                @endcan
{{--                @can('view', App\Permission::class)--}}
                    <li class="nav-item">
                        <a href="admin/order/list" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Order list
                            </p>
                        </a>
                    </li>

                <li class="nav-item">
                    <a href="admin/coupon/list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Coupon list
                        </p>
                    </a>
                </li>
{{--                @endcan--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
