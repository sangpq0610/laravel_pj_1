<nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('backend.dashboard') }}" class="nav-link">Trang chủ</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{ $newOrders }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ $newOrders }} Thông báo mới</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('backend.order.newOrders') }}" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> có {{ $newOrders }} Đơn hàng chờ xác nhận
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </nav>