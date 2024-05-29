<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item @yield('anggota') ">
            <a href="{{url('/anggota')}}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Anggota / Peminjaman</span>
            </a>
        </li>
        <li class="sidebar-item @yield('buku') ">
            <a href="{{url('/buku')}}" class='sidebar-link'>
                <i class="bi bi-book-fill"></i>
                <span>Buku</span>
            </a>
        </li>
        <li class="sidebar-item @yield('peminjaman') ">
            <a href="{{url('/peminjaman')}}" class='sidebar-link'>
                <i class="bi bi-bag-fill"></i>
                <span>Peminjaman</span>
            </a>
        </li>


    </ul>
</div>
