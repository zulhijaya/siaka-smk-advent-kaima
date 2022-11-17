<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{ explode(' ', config('app.name'))[0] }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config('app.name') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        @php
            $user = auth()->user();
        @endphp
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img 
                            @if( $user->role == 'Siswa' && $user->siswa->foto )
                            src="{{ asset('storage/' . $user->siswa->foto) }}"
                            @elseif( ($user->role == 'Kepala Sekolah' || $user->role == 'Guru' || $user->role == 'Bendahara') && $user->guru->foto )
                            src="{{ asset('storage/' . $user->guru->foto) }}"
                            @else
                            src="{{ 'https://eu.ui-avatars.com/api/?name=' . implode('+', explode(' ', $user->nama)) }}" 
                            @endif
                            class="user-image" alt="User Image"
                        >
                        <span class="hidden-xs">{{ $user->nama }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
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

                            <p>
                                {{ $user->nama }}
                                <small>{{ $user->role }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                @if( $user->role == 'Siswa' )
                                <a href="{{ route('admin.siswa.detail', $user->siswa->id) }}" class="btn btn-default btn-flat">Profil</a>
                                @elseif( $user->role == 'Guru' || $user->role == 'Bendahara' )
                                <a href="{{ route('admin.guru.detail', $user->guru->id) }}" class="btn btn-default btn-flat">Profil</a>
                                @endif
                                <a href="{{ route('admin.user.edit-password') }}" class="btn btn-default btn-flat">Ganti password</a>
                            </div>
                            <div class="pull-right">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();" class="btn btn-default btn-flat">Logout</a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>