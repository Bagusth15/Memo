
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-file-alt"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Memo</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php if ($title == 'Dashboard'){ echo 'active'; }; ?>">
    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <?php if ($user['user_role'] == 'Administrator' || $user['user_role'] == 'Direktur'): ?>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master Data
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item <?php if ($title == 'Data User'){ echo 'active'; }; ?>">
        <a class="nav-link" href="<?= base_url('data_user'); ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>Data User</span></a>
        </li>
      <?php endif ?>

      <?php if ($user['user_role'] != 'Administrator' ): ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Memo
        </div>

          <li class="nav-item <?php if ($title == 'Memo Management'){ echo 'active'; }; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-file-alt fa-cog"></i>
              <span>Memo Management</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?= base_url('memo'); ?>">Memo Processed</a>
              <a class="collapse-item" href="<?= base_url('memo/finish_processed'); ?>">Memo Finish Processed</a>
            </div>
          </div>
        </li>

      <?php endif ?>
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Utilities
      </div>

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->
