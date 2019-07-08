<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Table Memo Processed</h1>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <?php if ($user['user_role'] != 'Direktur'): ?>
      <div class="card-header py-3">
        <a href="<?= base_url('memo/tambah'); ?>" class="btn btn-primary btn-sm">Buat Memo</a>
      </div>
    <?php endif ?>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>#</th>
              <th>No memo</th>
              <th>Tujuan</th>
              <th>Perihal</th>
              <th>Tgl Buat</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1 ;
            foreach ($memo as $mm) : ?>
              <?php if ($user['user_nik'] == $mm['mm_pengirim'] || $user['user_nik'] == $mm['mm_tujuan']): ?>
                <?php if ($mm['mm_status'] == 1): ?>
                  <tr align="center">
                    <td><?= $no++ ?></td>
                    <td><?= $mm['mm_id']; ?> / MI / PTHG</td>
                    <td><?= $mm['user_name']; ?><br>
                      (<?= $mm['user_role']; ?> <?= $mm['user_bagian']; ?>)
                    </td>
                    <td><?= $mm['mm_perihal']; ?></td>
                    <td><?= date('d F Y', $mm['mm_tgl_buat']); ?></td>
                    <td>
                      <?php 
                      if ($mm['mm_status'] == 1){
                        echo "Sedang Diproses";
                      } else if($mm['mm_status'] == 2){
                        echo "Aproved";
                      } else if($mm['mm_status'] == 3){
                        echo "Not Aproved";
                      } 
                      ?>
                    </td>
                    <td>
                      <a href="<?= base_url(); ?>memo/detail/<?= $mm['mm_id']; ?>" class="btn btn-primary btn-sm">Detail</a>
                      <?php if ($user['user_nik'] == $mm['mm_pengirim'] ): ?>
                        <?php if ($mm['mm_status'] != 3 ): ?>
                          <a href="<?= base_url(); ?>memo/edit/<?= $mm['mm_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <?php endif ?>
                        <a onclick="return confirm('Yakin akan menghapus data?');" href="<?= base_url(); ?>memo/hapus/<?= $mm['mm_id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endif ?>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
