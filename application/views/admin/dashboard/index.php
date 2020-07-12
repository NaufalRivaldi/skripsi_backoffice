<!doctype html>
<html lang="en">

 
<head>
  <!-- header -->
  <?php $this->load->view('admin/layout/header') ?>
</head>

<body>
  <div class="dashboard-main-wrapper">
    <!-- navbar -->
    <?php $this->load->view('admin/layout/navbar') ?>
    
    <!-- sidebar -->
    <?php $this->load->view('admin/layout/sidebar') ?>
      
    <!-- wrapper  -->
    <div class="dashboard-wrapper">
      <div class="container-fluid  dashboard-content">
        <!-- breadcrumb -->
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <!-- alert -->
        <?php $this->load->view('admin/layout/alert') ?>

        <!-- content -->
        <?php if($this->session->userData('level') != '3'): ?>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="text-muted">Tenant</h5>
                <div class="metric-value d-inline-block float-left mr-3">
                  <h1 class="mb-1 text-primary"><?= $countTenant ?></h1>
                </div>
                <div class="metric-label d-inline-block float-left text-success">Person</div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h2>Welcome to BACK OFFICE FINANCE INFORMATION SYSTEM.</h2>
                <p class=text-muted>Happy working <?= $this->session->userdata('name') ?>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <?php if(empty($cekPembayaran)): ?>
      <div class="alert alert-danger" role="alert">
        <b>You haven't made a payment <?= date('F') ?>, make a payment? contact finance immediately.</b>
      </div>
      <?php endif ?>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3 class="text-muted">Data Tenant</h3>
            </div>
            <div class="card-body">
              <h4>Code Tenant</h4>
              <p><?= $tenant->code ?></p>
              <h4>Name</h4>
              <p><?= $tenant->name ?></p>
              <h4>PIC</h4>
              <p><?= $tenant->pic ?></p>
              <h4>Phone</h4>
              <p><?= $tenant->phone ?></p>
              <h4>Status</h4>
              <p><?= status($tenant->status) ?></p>
              <h4>Location</h4>
              <p><?= $tenant->codeLocation.' - '.$tenant->nameLocation ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h2>Welcome to BACK OFFICE FINANCE INFORMATION SYSTEM</h2>
              <p class=text-muted>Get your payment information in here.</p>
            </div>
          </div>
        </div>
      </div>
      <?php endif ?>
      <!-- footer -->
      <?php $this->load->view('admin/layout/footer') ?>
    </div>
  </div>
  
  <!-- Optional JavaScript -->
  <?php $this->load->view('admin/layout/javascript') ?>
</body>
 
</html>