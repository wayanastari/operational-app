<div class="header">
    <!-- Left Side - Menu & Title -->
    <div style="display: flex; align-items: center; gap: 15px;">
        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Page Title -->
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>
    
    <!-- Right Side - User Menu -->
    <div class="user-menu">
        <!-- Notifications -->
        <button style="background: none; border: none; color: #666; cursor: pointer; padding: 8px; border-radius: 50%; transition: background 0.2s;" 
                onmouseover="this.style.backgroundColor='#f8f9fa'" 
                onmouseout="this.style.backgroundColor='transparent'">
            <i class="fas fa-bell" style="font-size: 18px; position: relative;">
                <!-- Notification Badge -->
                <span style="position: absolute; top: -5px; right: -5px; width: 8px; height: 8px; background: #dc3545; border-radius: 50%;"></span>
            </i>
        </button>
        
        <!-- User Avatar & Dropdown -->
        <div style="position: relative;">
            <div class="user-avatar" onclick="toggleDropdown()">A</div>
            
            <!-- User Dropdown Menu -->
            <div id="userDropdown" style="position: absolute; right: 0; top: 50px; width: 200px; background: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: none; z-index: 1000;">
                <!-- User Info Section -->
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <div style="font-weight: bold; color: #333;">Admin User</div>
                    <div style="font-size: 14px; color: #666;">admin@example.com</div>
                </div>
                
                <!-- Menu Items -->
                <div style="padding: 10px 0;">
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 8px 15px; color: #666; text-decoration: none; transition: background 0.2s;"
                       onmouseover="this.style.backgroundColor='#f8f9fa'" 
                       onmouseout="this.style.backgroundColor='transparent'">
                        <i class="fas fa-user" style="width: 16px;"></i>
                        Profile
                    </a>
                    
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 8px 15px; color: #666; text-decoration: none; transition: background 0.2s;"
                       onmouseover="this.style.backgroundColor='#f8f9fa'" 
                       onmouseout="this.style.backgroundColor='transparent'">
                        <i class="fas fa-cog" style="width: 16px;"></i>
                        Settings
                    </a>
                    
                    <!-- Divider -->
                    <hr style="margin: 8px 0; border: none; border-top: 1px solid #eee;">
                    
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 8px 15px; color: #dc3545; text-decoration: none; transition: background 0.2s;"
                       onmouseover="this.style.backgroundColor='#f8f9fa'" 
                       onmouseout="this.style.backgroundColor='transparent'">
                        <i class="fas fa-sign-out-alt" style="width: 16px;"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>