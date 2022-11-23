<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    @php
        $user = auth()->user();
    @endphp
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                {{-- <img src="{{ 'https://eu.ui-avatars.com/api/?name=' . implode('+', explode(' ', $user->nama)) }}" class="img-circle" alt="User Image"> --}}
                <img
                    @if( $user->role == 'Siswa' && $user->siswa->foto )
                    src="{{ asset('storage/' . $user->siswa->foto) }}"
                    @elseif( ($user->role == 'Kepala Sekolah' || $user->role == 'Guru' || $user->role == 'Bendahara') && $user->guru->foto )
                    src="{{ asset('storage/' . $user->guru->foto) }}"
                    @else
                    src="{{ 'https://eu.ui-avatars.com/api/?name=' . implode('+', explode(' ', $user->nama)) }}"
                    @endif
                    class="img-circle" alt="User Image"
                >
            </div>
            <div class="pull-left info">
                <p>{{ $user->nama }}</p>
                <p>{{ $user->role }}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            @if( $user->role == 'Administrator' || $user->role == 'Kepala Sekolah' )
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Data Siswa</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.siswa.calon-siswa') }}"><i class="fa fa-circle-o"></i> Data Calon Siswa</a></li>
                    <li><a href="{{ route('admin.siswa.siswa-aktif') }}"><i class="fa fa-circle-o"></i> Data Siswa Aktif</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.guru.index') }}">
                    <i class="fa fa-table"></i> <span>Data Tenaga Pendidik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kelas.index') }}">
                    <i class="fa fa-table"></i> <span>Data Kelas</span>
                </a>
            </li>
            @endif
            @if( $user->role == 'Administrator' )
            <li>
                <a href="{{ route('admin.jurusan.index') }}">
                    <i class="fa fa-table"></i> <span>Data Jurusan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.mapel.index') }}">
                    <i class="fa fa-table"></i> <span>Data Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tahun-ajaran.index') }}">
                    <i class="fa fa-table"></i> <span>Data Tahun Ajaran</span>
                </a>
            </li>
            @endif
            @if( ($user->role == 'Guru' || $user->role == 'Kepala Sekolah') && $user->load('guru.jadwal2')->guru->jadwal2->count()  )
            <li>
                <a href="{{ route('admin.guru.nilai.input-nilai') }}">
                    <i class="fa fa-table"></i> <span>Input Nilai</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.guru.absensi.input-absensi') }}">
                    <i class="fa fa-table"></i> <span>Input Absensi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.guru.jadwal-mengajar') }}">
                    <i class="fa fa-table"></i> <span>Jadwal Mengajar</span>
                </a>
            </li>
                @php
                    $guru = $user->load('guru.kelas')->guru;
                @endphp
                @if( $guru->id_kelas )
                <li>
                    <a href="{{ route('admin.kelas.jadwal.index', $guru->id_kelas) }}">
                        <i class="fa fa-table"></i> <span>Jadwal Kelas {{ $guru->kelas->tingkat }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.rapor.index') }}">
                        <i class="fa fa-table"></i> <span>Rapor</span>
                    </a>
                </li>
                @endif
            @endif
            @if( $user->role == 'Bendahara' )
            <li>
                <a href="{{ route('admin.tagihan.index') }}">
                    <i class="fa fa-table"></i> <span>Tagihan</span>
                </a>
            </li>
            @endif
            @if( $user->role == 'Siswa' )
            <li>
                <a href="{{ route('admin.siswa.jadwal-mapel') }}">
                    <i class="fa fa-table"></i> <span>Jadwal Mapel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.nilai') }}">
                    <i class="fa fa-table"></i> <span>Nilai</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.absensi') }}">
                    <i class="fa fa-table"></i> <span>Absensi</span>
                </a>
            </li>
                @if( \App\Models\Setting::first()->izinkan_siswa_akses_rapor )
                <li>
                    <a href="{{ route('admin.rapor.detail', $user->siswa->id) }}">
                        <i class="fa fa-table"></i> <span>Rapor</span>
                    </a>
                </li>
                @endif
            <li>
                <a href="{{ route('admin.siswa.tagihan') }}">
                    <i class="fa fa-table"></i> <span>Tagihan</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('admin.pengumuman.index') }}">
                    <i class="fa fa-table"></i> <span>Pengumuman</span>
                </a>
            </li>
            @if( $user->role == 'Administrator' )
            <li>
                <a href="{{ route('admin.visi-misi.index') }}">
                    <i class="fa fa-table"></i> <span>Visi & Misi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.setting.index') }}">
                    <i class="fa fa-table"></i> <span>Setting</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
