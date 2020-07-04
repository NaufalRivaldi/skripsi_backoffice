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
                <div class="row">
                  <div class="col-md-8">
                    <a href="<?= site_url('tenant/form') ?>" class="btn btn-primary">
                      <i class="fas fa-plus-circle"></i> Add Tenant
                    </a>
                  </div>
                  <div class="col-md-4">
                    <form action="<?= site_url('tenant') ?>" method="GET" id="formFilter">
                      <div class="row justify-content-end">
                        <div class="col-md-6">
                          <select name="status" id="status" class="form-control">
                            <option value="">Pilih Status</option>
                            <option value="1" <?= ($filter->status == '1')? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= ($filter->status == '0')? 'selected' : '' ?>>Nonactive</option>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <table class="table table-striped table-bordered first">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tenant as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->code ?></td>
                        <td><?= $row->name ?></td>
                        <td><?= status($row->status) ?></td>
                        <td>
                          <a href="<?= site_url('tenant/view/'.$row->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
                          <a href="<?= site_url('tenant/form/'.$row->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-cog"></i></a>
                          <button class="btn btn-danger btn-sm delete" data-id="<?= $row->id ?>"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
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
    $(document).on('click', '.delete', function(){
      var id = $(this).data('id');
      
      Swal.fire({
        title: 'Delete Tenant?',
        text: "The data will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?= site_url('tenant/delete') ?>",
            type: 'POST',
            data: {
              id:id
            },
            success: function(data){
              location.reload();
            }
          });
        }
      })
    });

    $(document).on('change', '#formFilter', function(){
      $('#formFilter').submit();
    });
  </script>
</body>
 
</html>