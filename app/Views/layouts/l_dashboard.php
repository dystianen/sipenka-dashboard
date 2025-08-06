<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/favicon.ico">
  <link rel="icon" href="<?= base_url(); ?>/favicon.ico">
  <title>
    SIPENKA
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/218d5eb4ba.js" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets'); ?>/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
  <?php
  $currentURI = uri_string();
  $segments = explode('/', $currentURI);

  // Mapping khusus untuk label
  $breadcrumbLabels = [
    'dashboard' => 'Dashboard',
    'products' => 'Products',
    'product-category' => 'Product Category',
    'inventory' => 'Inventory',
    'customers' => 'Customers',
    'customers/form' => 'Customer Form',
    'eye-examinations' => 'Eye Examinations',
  ];

  // Build breadcrumbs dengan URL
  $breadcrumbTrail = [];
  $path = '';
  foreach ($segments as $segment) {
    $path .= ($path === '' ? '' : '/') . $segment;
    $label = $breadcrumbLabels[$segment] ?? ucwords(str_replace('-', ' ', $segment));
    $breadcrumbTrail[] = [
      'label' => $label,
      'url' => base_url($path),
    ];
  }

  $currentPage = end($breadcrumbTrail)['label'];
  ?>

  <div class="position-fixed top-5 start-50 translate-middle p-3" style="z-index: 1100">
    <?php if (session()->getFlashData('failed')) : ?>
      <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          <?= session("failed") ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashData('success')) : ?>
      <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          <?= session("success") ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="min-height-400 position-fixed w-100" style="background-color: #A0937D"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand m-0 d-flex gap-2" href="<?= base_url('dashboard') ?>" target="_blank">
        <h5 class="ms-1 font-weight-bolder" style="font-size: 28px;">SIPENKA<span style="color: #A0937D">.</span></h5>
      </a>
    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <?php $role = session('role'); ?>

        <!-- Menu Umum -->
        <li class="nav-item">
          <a class="nav-link <?= $currentURI === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
            <div class="me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-tv"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <!-- Admin dan Kepala Sekolah -->
        <?php if (in_array($role, ['admin', 'kepala_sekolah'])) : ?>
          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'users' ? 'active' : '' ?>" href="/users">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users"></i>
              </div>
              <span class="nav-link-text ms-1">Users</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'teachers' ? 'active' : '' ?>" href="/teachers">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-tie"></i>
              </div>
              <span class="nav-link-text ms-1">Teachers</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'periods' ? 'active' : '' ?>" href="/periods">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-clock"></i>
              </div>
              <span class="nav-link-text ms-1">Periods</span>
            </a>
          </li>

          <hr />

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'criteria' ? 'active' : '' ?>" href="/criteria">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fab fa-envira"></i>
              </div>
              <span class="nav-link-text ms-1">Question Category</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'question-subcategories' ? 'active' : '' ?>" href="/question-subcategories">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fab fa-envira"></i>
              </div>
              <span class="nav-link-text ms-1">Question Subcategories</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'questions' ? 'active' : '' ?>" href="/questions">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fab fa-envira"></i>
              </div>
              <span class="nav-link-text ms-1">Questions</span>
            </a>
          </li>

          <hr />

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'pairwise-comparison' ? 'active' : '' ?>" href="/pairwise-comparison">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-cog"></i>
              </div>
              <span class="nav-link-text ms-1">Pairwise Comparison</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentURI === 'performance-assesment' ? 'active' : '' ?>" href="/performance-assesment">
              <div class="me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-tag"></i>
              </div>
              <span class="nav-link-text ms-1">Performance Assesment</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- Menu Umum -->
        <li class="nav-item">
          <a class="nav-link <?= $currentURI === 'evaluation-results' ? 'active' : '' ?>" href="/evaluation-results">
            <div class="me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-vial"></i>
            </div>
            <span class="nav-link-text ms-1">Evaluation Results</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content position-relative border-radius-lg d-flex flex-column justify-content-between min-vh-100">
    <div class="mx-4">
      <!-- Navbar -->
      <nav class="fixed navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-white" href="<?= base_url('dashboard') ?>">Pages</a>
              </li>

              <?php foreach (array_slice($breadcrumbTrail, 0, -1) as $item): ?>
                <li class="breadcrumb-item text-sm text-white">
                  <a href="<?= esc($item['url']) ?>" class="text-white opacity-8"><?= esc($item['label']) ?></a>
                </li>
              <?php endforeach; ?>

              <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                <?= esc($currentPage) ?>
              </li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0"><?= esc($currentPage) ?></h6>
          </nav>

          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto" />
            <ul class="navbar-nav justify-content-end">
              <li class="nav-item dropdown d-flex align-items-center">
                <a class="nav-link text-white font-weight-bold px-0 dropdown-toggle" onclick="showDropdown()" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user me-sm-1"></i>
                  <span class="d-sm-inline d-none"><?= session()->get('name') ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end d-none" id="userDropdown" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                </ul>
              </li>

              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <!-- Start Content -->
      <div class="container-fluid py-4">
        <?= $this->renderSection('content') ?>
      </div>
      <!-- End Content -->
    </div>
  </main>
  </div>

  <div class="fixed-plugin">
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?= base_url('assets'); ?>/js/core/popper.min.js"></script>
  <script src="<?= base_url('assets'); ?>/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url('assets'); ?>/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url('assets'); ?>/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    toastElList.map(function(toastEl) {
      const toast = new bootstrap.Toast(toastEl, {
        delay: 3000
      });
      toast.show();
    });

    function showDropdown() {
      const dropdowns = document.getElementsByClassName('dropdown-menu');
      if (dropdowns.length > 0) {
        const dropdown = dropdowns[0];
        dropdown.classList.remove('d-none'); // menghapus class d-none
      }
    }
  </script>

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('assets'); ?>/js/argon-dashboard.min.js?v=2.1.0"></script>

  <?= $this->renderSection('scripts') ?>
</body>

</html>