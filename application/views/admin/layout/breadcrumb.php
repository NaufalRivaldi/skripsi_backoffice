<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
      <h3 class="mb-2"><?= $title ?></h3>
      <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <?php for($i = 1; $i <= count($this->uri->segment_array()); $i++){ ?>
              <li class="breadcrumb-item"><?= ucwords($this->uri->segment($i)) ?></li>
            <?php } ?>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>