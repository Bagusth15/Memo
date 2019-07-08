<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Tambah User</h1>

  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample" action="<?= base_url('data_user/tambah'); ?>" method="post">
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" id="user_nik" name="user_nik" value="<?= set_value('user_nik'); ?>">
              <?= form_error('user_nik', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">Nama Lengkap</label>
              <input type="text" class="form-control" id="user_name" name="user_name" value="<?= set_value('user_name'); ?>">
              <?= form_error('user_name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">No Telp</label>
              <input type="number" class="form-control" id="user_no_telp" name="user_no_telp" value="<?= set_value('user_no_telp'); ?>">
              <?= form_error('user_no_telp', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">Email</label>
              <input type="email" class="form-control" id="user_email" name="user_email" value="<?= set_value('user_email'); ?>">
              <?= form_error('user_email', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">Password</label>
              <input type="password" class="form-control" id="user_password" name="user_password">
              <?= form_error('user_password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Role</label>
              <select class="form-control" id="user_role" name="user_role">
                <option>-- Pilih Satu --</option>
                <option value="Administrator">Administrator</option>
                <option value="Direktur">Direktur</option>
                <option value="Manager">Manager</option>
                <option value="Staff">Staff</option>
              </select>
            </div>
            <div class="form-group">
              <label for="nik">Bagian</label>
              <input type="text" class="form-control" id="user_bagian" name="user_bagian" value="<?= set_value('user_bagian'); ?>">
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Status</label>
              <select class="form-control" id="user_is_active" name="user_is_active">
                <option>-- Pilih Satu --</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary mr-1">Tambah</button>
            <button type="reset" class="btn btn-success mr-1">Reset</button>
            <a href="<?= base_url('memo'); ?>" class="btn btn-danger">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
