<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">My Profil</h1>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="border-bottom text-center pb-1">
                <img src="<?= base_url('assets/img/default-user.png'); ?>" alt="profile" class=" rounded-circle mb-2" width="100" />
                <p><?= $user['user_name']; ?>
                <br>
                <small>
                  <?= $user['user_role']; ?>
                </small></p>
                
              </div>
              <div class="py-3">
                <p class="clearfix">
                  <span class="float-left"> Status </span>
                  <span class="float-right text-muted"> 
                    <?php if ($user['user_is_active'] == 1) {
                      echo "Aktif";
                    } else {
                      echo "Tidak Aktif";
                    }; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> NIK </span>
                    <span class="float-right text-muted"><?= $user['user_nik']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Nama Lengkap </span>
                    <span class="float-right text-muted"><?= $user['user_name']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Email </span>
                    <span class="float-right text-muted"><?= $user['user_email']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> No. HP </span>
                    <span class="float-right text-muted"><?= $user['user_no_telp']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> User Created </span>
                    <span class="float-right text-muted"><?= date('d F Y', $user['user_date_created']); ?></span>
                  </p>
                </div>
                <a href="<?= base_url('user/edit'); ?>" class="btn btn-info btn-block">Edit</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
