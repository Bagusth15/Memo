<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample" method="post">
            <div class="form-group">
              <input type="hidden" id="user_id" name="user_id" value="<?= $data_user['user_id']; ?>">
              <label for="exampleSelectGender">Role</label>
              <select class="form-control" id="user_role" name="user_role">
                <option value="<?= $data_user['user_role']; ?>"><?= $data_user['user_role']; ?></option>
                <option value="0">-- Pilih Satu --</option>
                <option value="Administrator">Administrator</option>
                <option value="Direktur">Direktur</option>
                <option value="Manager">Manager</option>
                <option value="Staff">Staff</option>
              </select>
            </div>
            <div class="form-group">
              <label for="nik">Bagian</label>
              <input type="text" class="form-control" id="user_bagian" name="user_bagian" value="<?= $data_user['user_bagian']; ?>">
              
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Status</label>
              <select class="form-control" id="user_is_active" name="user_is_active">
                <option value="<?= $data_user['user_is_active']; ?>">-- Pilih Satu --</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary mr-1">Edit</button>
            <button type="reset" class="btn btn-success mr-1">Reset</button>
            <a href="<?= base_url('data_user'); ?>" class="btn btn-danger">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
