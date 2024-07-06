<aside class="app-sidebar bg-primary-subtle shadow" data-bs-theme="dark">
    <div class="sidebar-brand"> 
        <a href="index.php" class="brand-link"> 
            <img src="assets/img/properties/logo.png" alt="Logo" class="brand-image rounded-circle">
            <span class="brand-text fw-light small">Sistem Informasi <br> Tumbuh Kembang Anak</span>
        </a> 
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> 
                    <a href="index.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/index.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a href="pemeriksaan.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/pemeriksaan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-notes-medical"></i>
                        <p>Pemeriksaan</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="anak.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/anak.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-baby"></i>
                        <p>Anak</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="user.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/user.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>User</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="dokter.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/dokter.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-user-md"></i>
                        <p>Dokter</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="laporan.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/laporan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item"> 
                    <a href="log.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tumbuh_kembang_anak/log.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-history"></i>
                        <p>Log</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div> 
</aside> 