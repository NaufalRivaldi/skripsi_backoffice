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
                <a href="<?= site_url('user') ?>" class="btn btn-primary">
                  <i class="fas fa-arrow-alt-circle-left"></i> Back
                </a>
              </div>

              <div class="card-body">
                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <form action="<?= (empty($user->id))? site_url('user/store') : site_url('user/update') ?>" method="POST">
                      <?php if(!empty($user->id)): ?>
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                      <?php endif ?>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?= $user->name ?>">

                        <small class="text-danger"><?= form_error('name') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?= $user->username ?>">

                        <small class="text-danger"><?= form_error('username') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="level">Position</label>
                        <select name="level" id="level" class="form-control">
                          <option value="">Pilih</option>
                          <option value="1" <?= ($user->level == '1')?'selected':'' ?>>Finance</option>
                          <option value="2" <?= ($user->level == '2')?'selected':'' ?>>Leader</option>
                        </select>

                        <small class="text-danger"><?= form_error('level') ?></small>
                      </div>

                      <?php if(!empty($user->id)): ?>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                          <option value="">Pilih</option>
                          <option value="0" <?= ($user->status == '0')?'selected':'' ?>>Nonactive</option>
                          <option value="1" <?= ($user->status == '1')?'selected':'' ?>>Active</option>
                        </select>

                        <small class="text-danger"><?= form_error('status') ?></small>
                      </div>
                      <?php endif ?>

                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                      <button type="reset" class="btn btn-warning"><i class="fas fa-sync"></i> Reset</button>
                    </form>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <p>*Password will be set default '12345'</p>
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