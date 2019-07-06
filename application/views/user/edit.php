<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">My Profil</h1>

  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <?= form_open_multipart('user/edit'); ?>
          <form class="forms-sample">
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id']; ?>">
              <input type="text" class="form-control" id="user_nik" name="user_nik" value="<?= $user['user_nik']; ?>">
            </div>
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="user_name" name="user_name" value="<?= $user['user_name']; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">No Telp</label>
              <input type="number" class="form-control" id="user_no_telp" name="user_no_telp" value="<?= $user['user_no_telp']; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Email</label>
              <input type="email" class="form-control" id="user_email" name="user_email" value="<?= $user['user_email']; ?>">
            </div>
            <!-- <div class="form-group">
              <label for="exampleSelectGender">Jenis Kelamin</label>
              <select class="form-control" id="exampleSelectGender">
                <option>-- Pilih Jenis Kelamin --</option>
                <option>Pria</option>
                <option>Wanita</option>
              </select>
            </div> -->
            <button type="submit" class="btn btn-primary mr-1">Edit</button>
            <button type="reset" class="btn btn-success mr-1">Reset</button>
            <a href="<?= base_url('user'); ?>" class="btn btn-danger">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
