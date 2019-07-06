  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register</h1>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="user_nik" name="user_nik" placeholder="NIK" value="<?= set_value('user_nik'); ?>">
                  <?= form_error('user_nik', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="user_name" name="user_name" placeholder="Nama Lengkap" value="<?= set_value('user_name'); ?>">
                  <?= form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="user_no_telp" name="user_no_telp" placeholder="No Telp" value="<?= set_value('user_no_telp'); ?>">
                  <?= form_error('user_no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="user_email" name="user_email" placeholder="Email" value="<?= set_value('user_email'); ?>">
                  <?= form_error('user_email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="user_password1" name="user_password1" placeholder="Password">
                    <?= form_error('user_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="user_password2" name="user_password2" placeholder="Repeat Password">
                    <?= form_error('user_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="auth/forgotpassword">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
