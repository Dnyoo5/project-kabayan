<div class="sidebar sidebar-style-1">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hizrian
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item active">
                    <a href="/home">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a href="/barang">
                        <i class="fas fa-layer-group"></i>
                        <p>Table Barang</p>

                    </a>
                <li class="nav-item">
                    <a href="{{ url('/kategori') }}">
                        <i class="fas fa-table"></i>
                        <p>Tabel Kategori</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="/supplier">
                        <i class="flaticon-box-1"></i>
                        <p>Manajemen Supplier</p>

                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="flaticon-delivery-truck"></i>
                        <p>Pengiriman & Penerimaan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/pengiriman">
                                    <span class="sub-item">Pengiriman</span>
                                </a>
                            </li>
                            <li>
                                <a href="/penerimaan">
                                    <span class="sub-item">Penerimaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="/transaksi">
                        <i class="far fa-credit-card"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                </li>
            </ul>
        </div>
    </div>
</div>
