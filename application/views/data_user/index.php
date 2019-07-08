<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Table User</h1>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?= base_url('data_user/tambah') ?>" class="btn btn-primary">Tambah Data</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>#</th>
              <th>Nama Lengkap</th>
              <th>No Telp</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1 ?>
            <?php foreach ($data_user as $du): ?>
              <tr align="center">
                <td><?= $no++; ?></td>
                <td><?= $du['user_name']; ?></td>
                <td><?= $du['user_no_telp']; ?></td>
                <td><?= $du['user_email']; ?></td>
                <td><?= $du['user_role']; ?></td>
                <td>
                  <?php if ($du['user_is_active'] == 1) {
                    echo "Aktif";
                  } else {
                    echo "Tidak Aktif";
                  } ?>

                </td>
                <td>
                  <a href="<?= base_url(); ?>data_user/edit/<?= $du['user_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                  <a onclick="return confirm('Yakin akan menghapus data?');" href="<?= base_url(); ?>data_user/hapus/<?= $du['user_id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
