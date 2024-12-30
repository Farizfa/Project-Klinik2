<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-th"></i>
          <p>
            Master
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('admin.dokter')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dokter</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.pasien')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Pasien</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.poli')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Poli</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.obat')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Obat</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <form action="{{route('admin.logout')}}" method="POST">
            @csrf
            <button class="btn btn-danger btn-block" type="submit">Logout</button>
        </form>
      </li>
    </ul>
  </nav>