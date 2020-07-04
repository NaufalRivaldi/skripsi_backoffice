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
                <a href="<?= site_url('report') ?>" class="btn btn-primary">
                  <i class="fas fa-arrow-alt-circle-left"></i> Back
                </a>

                <a href="<?= site_url('invoice/print/'.$invoice->id) ?>" class="btn btn-success">
                  <i class="fas fa-print"></i> Print
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <div class="card-header">
                <h3 class="display-7">Invoice : <?= $invoice->number ?></h3>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th width="20%">Code</th>
                          <td width="1%">:</td>
                          <td id="codeTenant"></td>
                        </tr>
                        <tr>
                          <th width="10%">Name</th>
                          <td width="1%">:</td>
                          <td id="nameTenant"></td>
                        </tr>
                        <tr>
                          <th width="10%">Attn</th>
                          <td width="1%">:</td>
                          <td id="picTenant"></td>
                        </tr>
                        <tr>
                          <th width="10%">Phone</th>
                          <td width="1%">:</td>
                          <td id="phoneTenant"></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th width="20%">No Invoice</th>
                          <td width="1%">:</td>
                          <td id="number"><?= $invoice->number ?></td>
                        </tr>
                        <tr>
                          <th width="10%">Date</th>
                          <td width="1%">:</td>
                          <td id="date"><?= setDate($invoice->date) ?></td>
                        </tr>
                        <tr>
                          <th width="10%">Jatuh Tempo</th>
                          <td width="1%">:</td>
                          <td id="dueDate"><?= setDate($invoice->dueDate) ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                </div>
                <hr>
                <div class="row">

                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Total</th>
                            <th>PPN (10%)</th>
                            <th>GrandTotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td><?= $invoice->description ?></td>
                            <td class="text-right"><?= number_format($invoice->total) ?></td>
                            <td class="text-right"><?= number_format($invoice->ppn) ?></td>
                            <td class="text-right"><?= number_format($invoice->grandTotal) ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header font-weight-bold">
                        Note
                      </div>
                      <div class="card-body">
                        <?= $invoice->note ?>
                      </div>
                    </div>
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

    <?php if(!empty($invoice->id)): ?>
    $.ajax({
      url: "<?= site_url('invoice/setTenant') ?>",
      type: 'GET',
      dataType: 'json',
      data: {
        'id': '<?= $invoice->tenantId ?>'
      },
      success: function(data){
        $('#codeTenant').empty();
        $('#nameTenant').empty();
        $('#picTenant').empty();
        $('#phoneTenant').empty();

        $('#codeTenant').append(data.code);
        $('#nameTenant').append(data.name);
        $('#picTenant').append(data.pic);
        $('#phoneTenant').append(data.phone);
      }
    });
    <?php endif ?>
  </script>
</body>
 
</html>