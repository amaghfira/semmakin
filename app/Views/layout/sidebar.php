<!-- Sidebar Start -->
<aside class="left-sidebar" id="left-sidebar">
  <!-- Add this button to your markup -->

  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="<?= base_url(); ?>" class="text-nowrap logo-img">
        <img src="<?= base_url(); ?>/dist/images/logos/logo-semmakin.png" width="80" alt="" />
        <!-- <h2>LOGO SEMMAKIN</h2> -->
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= base_url(); ?>" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">MENU KEMISKINAN</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= base_url(); ?>/entri" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">Entri</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= base_url(); ?>/analisis" aria-expanded="false">
            <span>
              <i class="ti ti-cards"></i>
            </span>
            <span class="hide-menu">Analisis</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">DATA PENDUKUNG</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= base_url(); ?>/update-podes" aria-expanded="false">
            <span>
              <i class="ti ti-login"></i>
            </span>
            <span class="hide-menu">Update Data Podes</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= base_url(); ?>/rekap-podes" aria-expanded="false">
            <span>
              <i class="ti ti-border-all"></i>
            </span>
            <span class="hide-menu">Tabel Rekap Data Podes</span>
          </a>
        </li>
        <!-- <li class="sidebar-item">
          <a class="sidebar-link" href="<?= base_url(); ?>/visualisasi" aria-expanded="false">
            <span>
              <i class="ti ti-chart-bar"></i>
            </span>
            <span class="hide-menu">Visualisasi</span>
          </a>
        </li> -->
        <?php if (session('role') == 9) : ?>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">ADMIN TOOLS</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?= base_url(); ?>/master" aria-expanded="false">
              <span>
                <i class="ti ti-database"></i>
              </span>
              <span class="hide-menu">Master Data</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?= base_url(); ?>/edit" aria-expanded="false">
              <span>
                <i class="ti ti-edit-circle"></i>
              </span>
              <span class="hide-menu">Edit Data</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?= base_url(); ?>/kelola" aria-expanded="false">
              <span>
                <i class="ti ti-users"></i>
              </span>
              <span class="hide-menu">Kelola User</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
        <div class="d-flex">
          <div class="unlimited-access-title me-3">
            <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Selamat Datang,</h6>
            <h6><?= session('instansi'); ?></h6>
          </div>
          <div class="unlimited-access-img">
            <img src="<?= base_url(); ?>/dist/images/backgrounds/rocket.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
