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
                  <div class="col-md-2">
                    <a href="<?= site_url('invoice/form') ?>" class="btn btn-primary">
                      <i class="fas fa-plus-circle"></i> Add Invoice
                    </a>
                  </div>
                  <div class="col-md-10">
                    <form action="<?= site_url('invoice') ?>" method="GET" id="formFilter">
                      <div class="row">
                        <div class="col-md-4">
                          <select name="tenantId" id="tenantId" class="form-control">
                            
                          </select>
                        </div>
                        <div class="col-md-3">
                          <input type="date" name="dateA" class="form-control" data-toggle="tooltip" data-placement="top" title="First Date" value="<?= $filter->dateA ?>">
                        </div>
                        <div class="col-md-3">
                          <input type="date" name="dateB" class="form-control" data-toggle="tooltip" data-placement="top" title="Last Date" value="<?= $filter->dateB ?>">
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
                          <a href="<?= site_url('invoice/view/'.$row->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
                          <a href="<?= site_url('invoice/form/'.$row->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-cog"></i></a>
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
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).on('click', '.delete', function(){
      var id = $(this).data('id');
      
      Swal.fire({
        title: 'Delete Invoice?',
        text: "The data will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?= site_url('invoice/delete') ?>",
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