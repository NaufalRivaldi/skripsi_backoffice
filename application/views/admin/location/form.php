<!doctype html>
<th lang="en">

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
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <div class="card-header">
                <a href="<?= site_url('location') ?>" class="btn btn-primary">
                  <i class="fas fa-arrow-alt-circle-left"></i> Back
                </a>
              </div>

              <div class="card-body">
                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <form action="<?= (empty($location->id))? site_url('location/store') : site_url('location/update') ?>" method="POST">
                      <?php if(!empty($location->id)): ?>
                        <input type="hidden" name="id" value="<?= $location->id ?>">
                      <?php endif ?>
                      <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control" id="code" value="<?= $location->code ?>">

                        <small class="text-danger"><?= form_error('code') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?= $location->name ?>">

                        <small class="text-danger"><?= form_error('name') ?></small>
                      </div>

                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                      <button type="reset" class="btn btn-warning"><i class="fas fa-sync"></i> Reset</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- footer -->
      <?php $this->load->view('admin/layout/footer') ?>
    </div>
  </div>
  
  <!-- Optional JavaScript -->
  <?php $this->load->view('admin/layout/javascript') ?>
</body>
 
</html>