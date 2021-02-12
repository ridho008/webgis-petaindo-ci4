<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-primary">
            <h4 class="card-title">Data</h4>
            <p class="card-category">Menu Data</p>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  <a href="/data/import" class="btn btn-primary">Tambah Data</a>
               </div>
               <div class="col-md-6">
                  <form class="navbar-form" action="/data" method="post">
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
                        <th>Nama Master Data</th>
                        <th>Nama Wilayah</th>
                        <th>Nilai</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1; foreach($data as $key => $d) : ?>
                        <tr>
                           <td><?= $offset + $key + 1; ?></td>
                           <td><?= $d->nama; ?></td>
                           <td><?= $d->nama_wilayah; ?></td>
                           <td><?= $d->nilai; ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'custom_pagination'); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>