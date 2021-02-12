<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<?php 
$csv = [
   'name' => 'csv',
   'id' => 'csv'
];
$submit = [
   'name' => 'submit',
   'id' => 'submit',
   'value' => 'Submit',
   'class' => 'btn btn-primary',
   'type' => 'submit'
];
?>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-primary">
            <h4 class="card-title">Import Kode Wilayah</h4>
            <p class="card-category">Menu Import Kode Wilayah</p>
         </div>
         <div class="card-body">
            <?= form_open_multipart('/kodeWilayah/import'); ?>
               <?= form_upload($csv); ?>
               <?= form_submit($submit); ?>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>