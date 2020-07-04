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
                  <div class="col-md-10">
                    <form action="<?= site_url('report/pembayaran') ?>" method="GET" id="formFilter">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="date" name="tglA" class="form-control" data-toggle="tooltip" data-placement="top" title="Tanggal Awal" value="<?= $filter->tglA ?>">
                        </div>
                        <div class="col-md-3">
                          <input type="date" name="tglB" class="form-control" data-toggle="tooltip" data-placement="top" title="Tanggal Akhir" value="<?= $filter->tglB ?>">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Search</button>
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
                      <th>Tanggal</th>
                      <th>Nomer</th>
                      <th>Tenant</th>
                      <th>Tanggal Jatuh Tempo</th>
                      <th>Total (Rp.)</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($invoice as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= setDate($row->tgl) ?></td>
                        <td><?= $row->nomer ?></td>
                        <td><?= $row->namaTenant ?></td>
                        <td><?= setDate($row->tglJatuhTempo) ?></td>
                        <td class="text-right"><?= number_format($row->grandTotal) ?></td>
                        <td>
                          <a href="<?= site_url('report/view/'.$row->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
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
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
  </script>
</body>
 
</html>