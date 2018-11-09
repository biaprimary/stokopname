<ul class="sidebar navbar-nav">
  <li class="nav-item {{ (current_page('dashboard')) ? 'active' : '' }}">
    <a class="nav-link" href="{{route('dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item dropdown {{ searchArray('show') }}">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true">
      <i class="fas fa-fw fa-folder"></i>
      <span>Master Data</span>
    </a>
    <div class="dropdown-menu {{ searchArray('show') }}" aria-labelledby="pagesDropdown">
      @if(Sentinel::inRole('admin'))
      <a class="dropdown-item {{ (current_page('suppliers')) ? 'active' : '' }}" href="{{route('suppliers.index')}}">Data Supplier</a>
      <a class="dropdown-item {{ (current_page('buyers')) ? 'active' : '' }}" href="{{route('buyers.index')}}">Data Buyer</a>
      @endif
      <a class="dropdown-item {{ (current_page('categories')) ? 'active' : '' }}" href="{{route('categories.index')}}">Data Kategori</a>
      <a class="dropdown-item {{ (current_page('items')) ? 'active' : '' }}" href="{{route('items.index')}}">Data Barang</a>
      @if(Sentinel::inRole('admin'))
      <a class="dropdown-item {{ (current_page('transactions')) ? 'active' : '' }}" href="{{route('transactions.index')}}">Data Transaksi</a>
      @endif
    </div>
  </li>
  <li class="nav-item {{ (current_page('report')) ? 'active' : '' }}">
    <a class="nav-link" href="{{route('report')}}">
      <i class="fas fa-fw fa-table"></i>
      <span>Laporan</span></a>
  </li>
</ul>
