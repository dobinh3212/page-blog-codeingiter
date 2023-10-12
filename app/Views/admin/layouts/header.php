<header class="header">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
      <svg class="icon icon-lg">
      </svg>
    </button>
    <ul class="header-nav d-md-flex">
      <li class="col-3 justify-content-center d-flex"><a class="nav-link" href="<?= base_url('admin') ?>">Dashboard</a></li>
      <li class="col-3 justify-content-center d-flex"><a class="nav-link" href="<?= base_url('admin/user') ?>">User</a></li>
      <li class="col-3 justify-content-center d-flex"><a class="nav-link" href="<?= base_url('admin/category') ?>">Category</a></li>
      <li class="col-3 justify-content-center d-flex"><a class="nav-link" href="<?= base_url('admin/post') ?>">Post</a></li>
    </ul>
    <ul class="header-nav ms-3">
      <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-md"><img class="avatar-img" src="<?= base_url('/img/ellipse.png') ?>" alt="user@email.com"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
          <div class="dropdown-header bg-light py-2">
            <div class="fw-semibold">Account</div>
          </div><a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
            </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
            </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-task"></use>
            </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
            </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
          <div class="dropdown-header bg-light py-2">
            <div class="fw-semibold">Settings</div>
          </div>
          <a class="dropdown-item" href="<?= route_to('getUser') ?>">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg> Profile</a><a class="dropdown-item" href="">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
            </svg> Settings</a><a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
            </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
            </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
          <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= route_to('attemptLogout') ?>">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</header>