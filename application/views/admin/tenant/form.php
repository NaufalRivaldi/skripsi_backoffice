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
                <a href="<?= site_url('tenant') ?>" class="btn btn-primary">
                  <i class="fas fa-arrow-alt-circle-left"></i> Back
                </a>
              </div>

              <div class="card-body">
                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <form action="<?= (empty($tenant->id))? site_url('tenant/store') : site_url('tenant/update') ?>" method="POST">
                      <?php if(!empty($tenant->id)): ?>
                        <input type="hidden" name="id" value="<?= $tenant->id ?>">
                      <?php endif ?>
                      <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control" id="code" value="<?= $tenant->code ?>">

                        <small class="text-danger"><?= form_error('code') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?= $tenant->name ?>">

                        <small class="text-danger"><?= form_error('name') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="pic">PIC</label>
                        <input type="text" name="pic" class="form-control" id="pic" value="<?= $tenant->pic ?>">

                        <small class="text-danger"><?= form_error('pic') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="<?= $tenant->phone ?>">

                        <small class="text-danger"><?= form_error('phone') ?></small>
                      </div>
                      
                      <?php if(!empty($tenant->id)): ?>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                          <option value="">Pilih</option>
                          <option value="0" <?= ($tenant->status == '0')?'selected':'' ?>>Nonactive</option>
                          <option value="1" <?= ($tenant->status == '1')?'selected':'' ?>>Active</option>
                        </select>

                        <small class="text-danger"><?= form_error('status') ?></small>
                      </div>
                      <?php endif ?>

                      <div class="form-group">
                        <label for="locationId">Location</label>
                        <select name="locationId" id="locationId" class="form-control">
                          <?php if(!empty($tenant->id)): ?>
                            <option value="<?= $tenant->locationId ?>" selected><?= $tenant->codeLocation.' - '.$tenant->nameLocation ?></option>
                          <?php endif ?>
                        </select>

                        <small class="text-danger"><?= form_error('locationId') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="rent">Rent (Rp.)</label>
                        <input type="number" name="rent" class="form-control" id="rent" value="<?= $tenant->rent ?>">

                        <small class="text-danger"><?= form_error('rent') ?></small>
                      </div>

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

  <script>
    $('#locationId').select2({
      placeholder: 'Cari lokasi',
      theme: "bootstrap",
      ajax: {
        url: "<?= site_url('tenant/loadLocation') ?>",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: $.map(data, function(item){
              return {
                text: item.code+' - '+item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });
  </script>
</body>
 
</html>