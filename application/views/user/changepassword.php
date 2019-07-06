<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Change Password</h1>

  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <?= $this->session->flashdata('message'); ?>
          <form class="forms-sample" method="post" action="<?= base_url('user/changepassword'); ?>">
            <div class="form-group">
              <label for="nik">Current Password</label>
              <input type="hidden" name="user_id" id="user_id">
              <input type="password" class="form-control" id="current_password" name="current_password">
              <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">New Password</label>
              <input type="password" class="form-control" id="new_password1" name="new_password1">
              <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">Confirm Password</label>
              <input type="password" class="form-control" id="new_password2" name="new_password2">
              <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
            </div>

            <button type="submit" class="btn btn-primary mr-1">Change Password</button>
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
