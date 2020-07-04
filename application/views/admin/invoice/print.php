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
      margin-top: 150px;
      margin-bottom: 50px;
      border-collapse: collapse;
    }

    .table-nominal > thead > tr > th{
      border: 1px solid #999;
      padding: 8px 20px;
    }

    .table-nominal > tbody > tr > td{
      border: 1px solid #999;
      padding: 8px 20px;
    }

    .table-nominal > tfoot > tr > td{
      border: 1px solid #999;
      padding: 8px 20px;
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
          <th width="20%" align="left">No.Unit</th>
          <td width="1%">:</td>
          <td id="codeTenant"><?= $invoice->codeTenant ?></td>
        </tr>
        <tr>
          <th width="20%" align="left">Name Tenant</th>
          <td width="1%">:</td>
          <td id="nameTenant"><?= $invoice->nameTenant ?></td>
        </tr>
        <tr>
          <th width="20%" align="left">Attn</th>
          <td width="1%">:</td>
          <td id="picTenant"><?= $invoice->pic ?></td>
        </tr>
        <tr>
          <th width="20%" align="left">Phone</th>
          <td width="1%">:</td>
          <td id="phone"><?= $invoice->phone ?></td>
        </tr>
      </table>
    </div>
    <div class="row">
      <table width="100%">
        <tr>
          <th width="60%" style="text-align: left">No Invoice</th>
          <td width="1%">:</td>
          <td id="number"><?= $invoice->number ?></td>
        </tr>
        <tr>
          <th width="60%" style="text-align: left">Date</th>
          <td width="1%">:</td>
          <td id="date"><?= setDate($invoice->date) ?></td>
        </tr>
        <tr>
          <th width="60%" style="text-align: left">Due Date</th>
          <td width="1%">:</td>
          <td id="dueDate"><?= setDate($invoice->dueDate) ?></td>
        </tr>
      </table>
    </div>

    <table width="100%" class="table-nominal">
      <thead>
        <tr align="center">
          <th width="5%">No</th>
          <th width="70%">Description</th>
          <th>Total (Rp.)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="center" height="300px" valign="top">1<br>2</td>
          <td valign="top">
            <?= $invoice->description ?><br>
            ppn
          </td>
          <td align="right" valign="top">
            <?= number_format($invoice->total) ?><br>
            <?= number_format($invoice->ppn) ?>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" align="center">Grand Total</td>
          <td align="right"><?= number_format($invoice->grandTotal) ?></td>
        </tr>
      </tfoot>
    </table>

    <div class="row note">
      <b>Note</b>
      <p><?= $invoice->note ?></p>
    </div>
    <div class="row ttd">
      <p>Denpasar, <?= date('d F Y') ?></p>
      <p style="margin-top:100px">( <u>Zenzen Guisi Halmis</u> )<br>Mall Manager</p>
    </div>
  </div>
  
  <!-- jquery 3.3.1 js-->
  <script src="<?= base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
  <script>
    $(document).ready(function(){
      
    });
  </script>
</body>
</html>