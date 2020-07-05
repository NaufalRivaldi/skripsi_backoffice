<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
  <div class="menu-list">
      <nav class="navbar navbar-expand-lg navbar-light">
          <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav flex-column">
                  <li class="nav-divider">
                      Menu
                  </li>
                  <li class="nav-item ">
                      <a class="nav-link" href="<?= site_url('dashboard') ?>"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                  </li>
                  
                  <li class="nav-item">
                      <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#master" aria-controls="master"><i class="fas fa-fw fa-database"></i>Master</a>
                      <div id="master" class="collapse submenu" style="">
                          <ul class="nav flex-column">
                            <?php if($this->session->userData('level') == 2): ?>
                              <li class="nav-item">
                                  <a class="nav-link" href="<?= site_url('user/') ?>">User</a>
                              </li>
                            <?php endif ?>
                            <?php if($this->session->userData('level') == 1): ?>
                              <li class="nav-item">
                                  <a class="nav-link" href="<?= site_url('location/') ?>">Location</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="<?= site_url('tenant/') ?>">Tenant</a>
                              </li>
                            <?php endif ?>
                          </ul>
                      </div>
                  </li>

                  <?php if($this->session->userData('level') == 1): ?>
                  <li class="nav-divider">
                      Features
                  </li>
                  <li class="nav-item ">
                      <a class="nav-link" href="<?= site_url('invoice') ?>"><i class="fa fa-fw fa-money-bill-alt"></i>Payment</a>
                  </li>
                  <?php endif ?>
                  <li class="nav-divider">
                      Report
                  </li>
                  <?php if($this->session->userData('level') != 3): ?>
                  <li class="nav-item ">
                      <a class="nav-link" href="<?= site_url('report') ?>"><i class="fa fa-fw fa-money-bill-alt"></i>Monthly Report</a>
                  </li>
                  <?php endif ?>
                  <?php if($this->session->userData('level') == 3): ?>
                  <li class="nav-item ">
                      <a class="nav-link" href="<?= site_url('report/payment') ?>"><i class="fa fa-fw fa-money-bill-alt"></i>Payment</a>
                  </li>
                  <?php endif ?>
              </ul>
          </div>
      </nav>
  </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->