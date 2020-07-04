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
                    <form action="<?= site_url('report') ?>" method="GET" id="formFilter">
                      <div class="row">
                        <div class="col-md-4">
                          <select name="tenantId" id="tenantId" class="form-control">
                            
                          </select>
                        </div>
                        <div class="col-md-3">
                          <input type="date" name="dateA" class="form-control" data-toggle="tooltip" data-placement="top" title="First Date" value="<?= $filter->dateA ?>">
                        </div>
                        <div class="col-md-3">
                          <input type="date" name="dateB" class="form-control" data-toggle="tooltip" data-placement="top" title="First Date" value="<?= $filter->dateB ?>">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Search</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="col-md-4 text-right">
                    <?php if(!empty($invoice)): ?>
                    <?php 
                      if($_GET){
                        $url = '?'.$_SERVER['QUERY_STRING'];
                      }  
                    ?>
                    <a href="<?= site_url('report/print'.$url) ?>" class="btn btn-success">
                      <i class="fas fa-print"></i> Print
                    </a>
                    <?php endif ?>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <?php $total = '0'; if(!empty($invoice)): ?>
                <table class="table table-striped table-bordered first">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Number</th>
                      <th>Tenant</th>
                      <th>Due Date</th>
                      <th>Total (Rp.)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($invoice as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= setDate($row->date) ?></td>
                        <td><?= $row->number ?></td>
                        <td><?= $row->nameTenant ?></td>
                        <td><?= setDate($row->dueDate) ?></td>
                        <td class="text-right"><?= number_format($row->grandTotal) ?></td>
                        <td>
                          <a href="<?= site_url('report/view/'.$row->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
                        </td>
                      </tr>
                    <?php $total += $row->grandTotal; ?>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5" class="text-center font-weight-bold">Total</td>
                      <td class="text-right font-weight-bold"><?= number_format($total) ?></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
                <?php else: ?>
                <p>Empty Data.</p>
                <?php endif ?>
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
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

    $('#tenantId').select2({
      placeholder: 'Search Tenant...',
      theme: "bootstrap",
      ajax: {
        url: "<?= site_url('invoice/loadTenant') ?>",
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