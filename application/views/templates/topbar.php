
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <?php if ($user['user_role'] == 'Administrator' || $user['user_role'] == 'Direktur'): ?>
          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user fa-fw"></i>
              <!-- Counter - Alerts -->
              <span class="badge badge-danger badge-counter"><?= $notif_userr; ?></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Notification User
              </h6>
              <?php foreach ($data_userr as $du): ?>
                <?php if ($du['user_is_active'] == 0 && $du['user_role'] == 0): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('data_user/edit/'); ?><?= $du['user_id']; ?>">
                  <div class="mr-3  ">
                    <div class="icon-circle bg-info">
                      <i class="fas fa-user text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?= date('d F Y', $du['user_date_created']); ?></div>
                    <span class="font-weight-bold">User <?= $du['user_name']; ?> Mendaftar</span>
                  </div>
                </a>
                <?php endif ?>
              <?php endforeach ?>
              <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('data_user'); ?>">Show All User</a>
            </div>
          </li>
        <?php endif ?>
        <?php if ($user['user_role'] != 'Administrator' && $user['user_role'] != 'Staff'): ?>
          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-file-alt fa-fw"></i>
              <!-- Counter - Alerts -->
              <span class="badge badge-danger badge-counter"><?= $notif; ?></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Notification Memo
              </h6>
              <?php foreach ($isi_notif as $in): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('memo/detail/'); ?><?= $in['mm_id']; ?>">
                  <div class="mr-3  ">
                    <div class="icon-circle bg-info">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?= date('d F Y', $in['mm_tgl_buat']); ?></div>
                    <span class="font-weight-bold">Memo Baru Dari <br> <?= $in['user_name']; ?> | <?= $in['user_role']; ?></span>
                  </div>
                </a>
              <?php endforeach ?>
              <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('memo'); ?>">Show All Memo</a>
            </div>
          </li>
        <?php endif ?>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['user_name']; ?></span>
            <img class="img-profile rounded-circle" src="<?= base_url('assets/'); ?>img/default-user.png">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('user'); ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              My Profil
            </a>
            <a class="dropdown-item" href="<?= base_url('user/edit'); ?>">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Edit Profil
            </a>
            <a class="dropdown-item" href="<?= base_url('user/changepassword'); ?>">
              <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
              Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
              <!-- End of Topbar -->