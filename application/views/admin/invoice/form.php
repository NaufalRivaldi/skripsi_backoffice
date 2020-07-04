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
                <a href="<?= site_url('invoice') ?>" class="btn btn-primary">
                  <i class="fas fa-arrow-alt-circle-left"></i> Back
                </a>
              </div>

              <div class="card-body">
                <form action="<?= (empty($invoice->id))? site_url('invoice/store') : site_url('invoice/update') ?>" method="POST">
                <?php if(!empty($invoice->id)): ?>
                  <input type="hidden" name="id" value="<?= $invoice->id ?>">
                <?php endif ?>

                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="number">Number Invoice</label>
                      <input type="text" name="number" class="form-control" id="number" value="<?= $invoice->number ?>" readonly>

                      <small class="text-danger"><?= form_error('number') ?></small>
                    </div>

                    <div class="form-group">
                      <label for="date">Date</label>
                      <input type="date" name="date" class="form-control" id="date" value="<?= $invoice->date ?>" readonly>
                      <small class="tiny-text text-muted">Data sudah diset otomatis.</small>

                      <small class="text-danger"><?= form_error('date') ?></small>
                    </div>

                    <div class="form-group">
                      <label for="dueDate">Due Date <span class="text-info">*Hari</span></label>
                      <input type="text" name="dueDate" class="form-control" id="dueDate" value="10" readonly>
                      <small class="tiny-text text-muted">Data sudah diset otomatis.</small>

                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tenantId">Tenant</label>
                      <select name="tenantId" id="tenantId" class="form-control">
                        <?php if(!empty($invoice->id)): ?>
                          <option value="<?= $invoice->idTenant ?>" selected><?= $invoice->codeTenant.' - '.$invoice->nameTenant ?></option>
                        <?php endif ?>
                      </select>

                      <small class="text-danger"><?= form_error('tenantId') ?></small>
                    </div>

                    <div class="card">
                      <div class="card-body">
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
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" name="description" class="form-control" id="description" value="<?= $invoice->description ?>">

                      <small class="text-danger"><?= form_error('description') ?></small>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="total">Total <span class="text-success">(Rp.)</span></label>
                      <input type="text" name="total" class="form-control" id="total" value="<?= $invoice->total ?>">

                      <small class="text-danger"><?= form_error('total') ?></small>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="note">Note</label>
                      <textarea name="note" id="note" rows="10" class="form-control"><?= $invoice->note ?></textarea>

                      <small class="text-danger"><?= form_error('note') ?></small>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="ppn">PPN <span class="text-info">(10%)</span></label>
                      <input type="number" name="ppn" class="form-control" id="ppn" value="<?= $invoice->ppn ?>" step="0.01" readonly>

                      <small class="text-danger"><?= form_error('ppn') ?></small>
                    </div>

                    <div class="form-group">
                      <label for="grandTotal">Grand Total <span class="text-success">(Rp.)</span></label>
                      <input type="number" name="grandTotal" class="form-control" id="grandTotal" value="<?= $invoice->grandTotal ?>" step="0.01" readonly>

                      <small class="text-danger"><?= form_error('grandTotal') ?></small>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= (empty($invoice->id))?'Create':'Save' ?> Invoice</button>
                
                </form>
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
    <?php if(!empty($invoice->id)): ?>
    $.ajax({
      url: "<?= site_url('invoice/setTenant') ?>",
      type: 'GET',
      dataType: 'json',
      data: {
        'id': '<?= $invoice->idTenant ?>'
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

    $('#tenantId').select2({
      placeholder: 'Search Tenant...',
      theme: "bootstrap",
      ajax: {
        url: "<?= site_url('invoice/loadTenantForm') ?>",
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

    $(document).on('change', '#tenantId', function(){
      var tenantId = $(this).val();
      
      $.ajax({
        url: "<?= site_url('invoice/setTenant') ?>",
        type: 'GET',
        dataType: 'json',
        data: {
          'id': tenantId
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
    });

    $(document).on('keyup', '#total', function(){
      var total = parseFloat($(this).val());
      var grandTotal = 0;
      var ppn = 0;

      ppn = total * 10 / 100;
      grandTotal = total + ppn;

      $('#ppn').val(ppn);
      $('#grandTotal').val(grandTotal);
    });
  </script>
</body>
 
</html>