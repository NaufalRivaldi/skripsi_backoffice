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
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="card">

              <div class="card-header">
                <h3 class="display-7">Data Tenant</h3>
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

          <div class="col-md-7">
            <div class="card">

              <div class="card-header">
                <h3 class="display-7">Payment History</h3>
              </div>

              <div class="card-body">
                <?php if(empty($cekPembayaran)): ?>
                <div class="alert alert-danger" role="alert">
                  <b>This tenant haven't made a payment <?= date('F') ?>, make a payment? klik <a href="<?= site_url('invoice/form') ?>">here</a>.</b>
                </div>
                <?php endif ?>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered first">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>No Inv</th>
                        <th>Due Date</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($invoice as $invoice): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= setDate($invoice->date) ?></td>
                        <td><?= $invoice->number ?></td>
                        <td><?= setDate($invoice->dueDate) ?></td>
                        <td align="right"><?= number_format($invoice->grandTotal) ?></td>
                        <td>
                          <a href="<?= site_url('tenant/viewInvoice/'.$invoice->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
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
        title: 'Hapus Data Tenant?',
        text: "Data akan terhapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
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
  </script>
</body>
 
</html>