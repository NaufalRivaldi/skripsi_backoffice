<div class="dashboard-header">
  <nav class="navbar navbar-expand-lg bg-white fixed-top">
    <a class="navbar-brand" href="index.html">
      <img src="<?= base_url('assets/images/logo/logo-mini.jpg') ?>" alt="logo" width="60">
      BACK OFFICE FINANCE INFORMATION SYSTEM
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto navbar-right-top">
        <li class="nav-item dropdown nav-user">
          <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('assets/images/logo/user.svg') ?>" alt="" class="user-avatar-md"> <?= $this->session->userdata('nama') ?> <i class="fas fa-angle-down ml-2"></i></a>
          <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
            <div class="nav-user-info">
              <span class="status"></span><span class="ml-2"><?= level($this->session->userdata('level')) ?></span>
            </div>
            <a class="dropdown-item" href="<?= site_url('repassword') ?>"><i class="fas fa-key mr-2"></i>Change Password</a>
            <a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>