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
                <a href="<?= site_url('dashboard') ?>" class="btn btn-primary">
                  <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                </a>
              </div>

              <div class="card-body">
                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <form action="<?= ($this->session->userData('level') == 3)?site_url('repassword/updatetenant'):site_url('repassword/update') ?>" method="POST">
                      <div class="form-group">
                        <label for="passwordOld">Password Lama</label>
                        <input type="password" name="passwordOld" class="form-control" id="passwordOld">

                        <small class="text-danger"><?= form_error('passwordOld') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="passwordNew1">Password Baru</label>
                        <input type="password" name="passwordNew1" class="form-control" id="passwordNew1">

                        <small class="text-danger"><?= form_error('passwordNew1') ?></small>
                      </div>

                      <div class="form-group">
                        <label for="passwordNew2">Confirmasi Password</label>
                        <input type="password" name="passwordNew2" class="form-control" id="passwordNew2">

                        <small class="text-danger"><?= form_error('passwordNew2') ?></small>
                      </div>

                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                      <button type="reset" class="btn btn-warning"><i class="fas fa-sync"></i> Batal</button>
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

  <script>
    $('#lokasiId').select2({
      placeholder: 'Cari lokasi',
      theme: "bootstrap",
      ajax: {
        url: "<?= site_url('tenant/loadLokasi') ?>",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: $.map(data, function(item){
              return {
                text: item.kode+' - '+item.nama,
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