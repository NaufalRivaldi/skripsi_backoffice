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
                    <form action="<?= site_url('report/payment') ?>" method="GET" id="formFilter">
                      <div class="row">
                        <div class="col-md-3">
                          <label for="">First Date</label>
                          <input type="date" name="dateA" class="form-control" value="<?= $filter->dateA ?>">
                        </div>
                        <div class="col-md-3">
                          <label for="">Last Date</label>
                          <input type="date" name="dateB" class="form-control" value="<?= $filter->dateB ?>">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success mt-4"><i class="fas fa-search"></i> Search</button>
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