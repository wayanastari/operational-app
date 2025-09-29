<div class="sidebar">
    <!-- Logo -->
    <div class="logo">Laravel</div>
    
    <!-- Navigation Menu -->
    <nav>
        <a href="#" class="nav-item">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>

        <div class="dropdown">
            <button class="dropdown-btn">
                <i class="fas fa-file-alt"></i>Master Data
                <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('branch.index') }}">Data Cabang</a>
                <a href="{{ route('garage.index') }}">Data Bengkel</a>
                <a href="#">Tipe Kendaraan dan Variant</a>
            </div>
        </div>
        
        <!-- Divider -->
        <div style="margin: 20px 20px; border-top: 1px solid #eee;"></div>
        
        <!-- Account Section -->
        <div style="padding: 0 20px; margin-bottom: 10px;">
            <small style="color: #999; font-weight: bold; text-transform: uppercase; font-size: 12px;">
                Account
            </small>
        </div>
        
        <a href="#" class="nav-item">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </nav>
</div>