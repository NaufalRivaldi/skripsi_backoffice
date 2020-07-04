<?php
  $date = '-';
  $dateA = $_GET['dateA'];
  $dateB = $_GET['dateB'];

  if(!empty($dateA) && !empty($dateB)){
    $date = setDate($dateA).' s/d '.setDate($dateB);
  }else if(!empty($dateA)){
    $date = setDate($dateA);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    .header{
      width:100%;
    }

    .header > .row{
      width: 50%;
      float:left;
      font-size: .8em;
    }

    .container{
      width:100%;
    }

    .container > .row{
      width: 50%;
      float:left;
      font-size: .8em;
    }

    .table-nominal{
      margin-top: 100px;
      margin-bottom: 50px;
      border-collapse: collapse;
      font-size: .8em;
    }

    .table-nominal > thead > tr > th{
      border: 1px solid #999;
      
    }

    .table-nominal > tbody > tr > td{
      border: 1px solid #999;
      
    }

    .table-nominal > tfoot > tr > td{
      border: 1px solid #999;
      
      font-weight: bold;
    }

    .note{
      border: 1px solid #999;
      padding: 20px;
    }

    .ttd{
      text-align:center;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="row">
      <h4>PT EKA JAYA AGUNG</h4>
      <p>
        JL. TEUKU UMAR NO. 1<br>
        DENPASAR BALI 80114<br>
        Phone. 0361257576<br>
        Fax. 0361257576
      </p>
    </div>
    <div class="row" style="text-align:right">
      <img src="assets/images/logo/logo.jpg" alt="logo" width="100">
    </div>
  </div>
  
  <br><br><br><br><br><br><br>
  <hr>
  <div class="container">
    <div class="row">
      <table>
        <tr>
          <th width="20%" align="left">Attachment</th>
          <td width="1%">:</td>
          <td id="codeTenant">Monthly Report</td>
        </tr>
        <tr>
          <th width="20%" align="left">User Name</th>
          <td width="1%">:</td>
          <td id="nameTenant"><?= $this->session->userData('name') ?></td>
        </tr>
        <tr>
          <th width="20%" align="left">Position</th>
          <td width="1%">:</td>
          <td id="picTenant"><?= level($this->session->userData('level')) ?></td>
        </tr>
        <tr>
          <th width="20%" align="left">Periode</th>
          <td width="1%">:</td>
          <td id="picTenant"><?= $date ?></td>
        </tr>
      </table>
    </div>
    <div class="row" style="text-align:right">
      Denpasar, <?= date('d F Y') ?>
    </div>

    <table width="100%" class="table-nominal">
      <thead>
        <tr align="center">
          <th width="5%">No</th>
          <th>Date</th>
          <th>Number</th>
          <th>Tenant</th>
          <th>Due Date</th>
          <th>Total (Rp.)</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; if(!empty($invoice)): ?>
          <?php foreach($invoice as $row): ?>
            <tr>
              <td align="center"><?= $no++ ?></td>
              <td><?= setDate($row->date) ?></td>
              <td><?= $row->number ?></td>
              <td><?= $row->nameTenant ?></td>
              <td><?= setDate($row->dueDate) ?></td>
              <td align="right"><?= number_format($row->grandTotal) ?></td>
            </tr>
            <?php $total += $row->grandTotal; ?>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" align="center">Grand Total</td>
          <td align="right"><?= number_format($total) ?></td>
        </tr>
      </tfoot>
    </table>
  </div>
  
  <!-- jquery 3.3.1 js-->
  <script src="<?= base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
  <script>
    $(document).ready(function(){
      
    });
  </script>
</body>
</html>