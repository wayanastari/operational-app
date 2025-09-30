<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Dashboard - @yield('title', 'Dashboard')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- CSS Embed -->
     @vite('resources/css/app.css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #ddd;
            padding: 20px 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .dropdown-btn {
            background: none; 
            border: none;
            color: #666; 
            padding: 15px 20px; 
            font-size: 16px; 
            cursor: pointer;
            width: 100%;
            text-align: left;
            outline: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .dropdown-btn:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .dropdown-content {
            display: none;
            background-color: #ffffff; 
        }

        .dropdown-content a {
            padding: 12px 20px 12px 40px; 
            color: #666;
            font-size: 15px;
            display: block;
            text-decoration: none;
        }

        .dropdown-content a.active {
            background-color: #fff3cd;
            color: #856404;
            border-right: 3px solid #ffc107;
        }

        .dropdown-content a:hover {
            background-color: #eee;
            color: #333;
        }

        .active .dropdown-content {
            display: block;
        }

        .dropdown.active .dropdown-btn .fa-chevron-down {
            transform: rotate(180deg);
            transition: transform 0.3s;
        }
        .dropdown-btn .fa-chevron-down {
            transition: transform 0.3s;
        }

        .logo {
            padding: 0 20px 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .nav-item {
            padding: 15px 20px;
            color: #666;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background-color: #f8f9fa;
            color: #333;
            text-decoration: none;
        }

        .nav-item.active {
            background-color: #fff3cd;
            color: #856404;
            border-right: 3px solid #ffc107;
        }

        /* Main Content Layout */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .user-avatar:hover {
            background: #5a6268;
        }

        /* Content Area */
        .content {
            padding: 30px;
        }

        /* Footer Styles */
        .footer {
            background: #fff;
            border-top: 1px solid #ddd;
            padding: 20px 30px;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: #666;
            cursor: pointer;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .content {
                padding: 15px;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .header {
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Include Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Include Navbar -->
        @include('layouts.navbar')

        <!-- Content Area - Kosong untuk diisi -->
        <div class="content">
            @yield('content')
            <x-dynamic-crud-modal />
        </div>

        <!-- Include Footer -->
        @include('layouts.footer')
    </div>

    <!-- Base JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }

        // Dapatkan semua elemen yang relevan
        const navItems = document.querySelectorAll('.nav-item');
        const dropdowns = document.querySelectorAll('.dropdown');
        
        // --- MENGATUR STATUS ACTIVE PADA NAVIGASI ---
        function setActiveNavItem(clickedElement) {
            // Hapus semua status 'active' dan buka/tutup
            navItems.forEach(item => item.classList.remove('active'));
            dropdowns.forEach(dropdown => dropdown.classList.remove('active'));

            // Menetapkan status 'active'
            if (clickedElement.classList.contains('nav-item')) {
                // Jika item tunggal diklik (misal: Dashboard)
                clickedElement.classList.add('active');
                
            } else if (clickedElement.closest('.dropdown-content')) {
                // Jika sub-item di dalam dropdown diklik (misal: Data Cabang)
                const parentDropdown = clickedElement.closest('.dropdown');
                parentDropdown.classList.add('active');
                // Tandai sub-item yang diklik sebagai aktif
                clickedElement.classList.add('active'); 
            }
        }

        // --- LISTENER UNTUK ITEM NAVIGASI BIASA (.nav-item) ---
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                                
                // Atur status aktif
                setActiveNavItem(this);
                
                // Optional: Update page title
                const title = this.textContent.trim();
                document.querySelector('.page-title').textContent = title;
            });
        });

        // --- LISTENER UNTUK DROPDOWN (Button dan Sub-Items) ---
        dropdowns.forEach(dropdown => {
            const dropdownBtn = dropdown.querySelector('.dropdown-btn');
            const subItems = dropdown.querySelectorAll('.dropdown-content a');

            // Event pada Tombol Dropdown (Master Data)
            dropdownBtn.addEventListener('click', function() {
                const isActive = dropdown.classList.contains('active');
                
                // Bersihkan semua status active kecuali dropdown ini jika sudah aktif
                navItems.forEach(item => item.classList.remove('active'));
                dropdowns.forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('active');
                    }
                });
                
                // Toggle dropdown yang diklik (buka/tutup)
                dropdown.classList.toggle('active');
            });
            
            // Event pada Sub-Item Dropdown (Data Cabang, dll.)
            subItems.forEach(sub => {
                sub.addEventListener('click', function(e) {

                    // Hapus kelas 'active' dari semua sub-item
                    subItems.forEach(s => s.classList.remove('active'));
                    
                    // Atur status aktif pada parent dropdown dan sub-item yang diklik
                    setActiveNavItem(this);
                    
                    // Optional: Update page title
                    const title = this.textContent.trim();
                    document.querySelector('.page-title').textContent = title;
                });
            });
        });

        // --- User Dropdown Toggle (di Header) ---
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        }
        
        // Tambahkan listener ke avatar user
        const userAvatar = document.querySelector('.user-avatar');
        if (userAvatar) {
            userAvatar.addEventListener('click', toggleUserDropdown);
        }

        // Close user dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userAvatar = document.querySelector('.user-avatar');
            
            if (dropdown && userAvatar && !userAvatar.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        function confirmDelete(id, name) {
            console.log('delete-form-'+id);
            Swal.fire({
                title: 'Hapus ' + name + '?',
                text: "Anda yakin ingin menghapus data " + name + "? Data yang terhapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#20b2aa',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function loadCrudModal(url, title){
            const modalElement = document.getElementById('crudModal');
            const modalBody = document.getElementById('crudModalBody');
            const modalTitle = document.getElementById('crudModalTitle');
            const modal = new bootstrap.Modal(modalElement);

            // Set title
            modalTitle.textContent = title;
            modalBody.innerHTML = '<div class="text-center p-5">Memuat Data...</div>';

            // Fetch content
            fetch(url,{
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }) .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal memuat konten modal.');
                }
                return response.text();
            }) .then(html => {
                modalBody.innerHTML = html;
                modal.show();
            }) .catch(error => {
                modalBody.innerHTML = '<div class="alert alert-danger">${error.message}</div>';
                modal.show();
            });
        }

        function openCreateModal(url, resourceName){
            loadCrudModal(url, 'Tambah Data ' + resourceName + ' Baru');
        }

        function openEditModal(url, resourceName){
            loadCrudModal(url, 'Edit Data ' + resourceName);
        }

        function openShowModal(url, resourceName){
            loadCrudModal(url, 'Lihat Data ' + resourceName);
        }

    </script>

    @stack('scripts')
</body>
</html>