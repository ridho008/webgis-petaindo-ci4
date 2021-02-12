<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-primary">
            <h4 class="card-title">Kode Wilayah</h4>
            <p class="card-category">Menu Kode Wilayah</p>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  <a href="/kodeWilayah/import" class="btn btn-primary">Tambah Data</a>
               </div>
               <div class="col-md-6">
                  <form class="navbar-form" action="/kodeWilayah" method="post">
                    <div class="input-group no-border">
                      <input type="text" value="" name="keyword" class="form-control" placeholder="Search...">
                      <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                  </form>
               </div>
            </div>
            <hr>
            <div class="table-responsive">
               <table class="table table-striped">
                  <thead class="text-primary">
                     <tr>
                        <th>No</th>
                        <th>Kode Wilayah</th>
                        <th>Nama Wilayah</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1 + (5 * ($currentPage - 1));
                     foreach($kode_wilayah as $key => $kw) : ?>
                        <tr>
                           <td><?= $no++; ?></td>
                           <td><?= $kw->kode_wilayah; ?></td>
                           <td><?= $kw->nama_wilayah; ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <?= $pager->links('kode_wilayah', 'custom_pagination') ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>