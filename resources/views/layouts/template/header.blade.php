<header class="mb-5">
    <div class="header-top">
        <div class="container ">
            <div class="logo">
                <a href="index.html" class="navbar-brand d-flex align-items-center">
                    <span class="fw-bold">Bengkel Bendot</span>
                </a>
            </div>
            <div class="header-top-right">
                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{ asset('assets/compiled/png/icons8-user-48.png') }}" alt="Avatar">
                        </div>
                        <div class="text">
                            <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                            <p class="mb-0 text-sm text-success">{{ ucwords(auth()->user()->roles[0]->name) }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        <li><a class="dropdown-item" href="{{route('profile.edit')}}">{{ Auth::user()->name }}</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar bg-primary">
        <div class="container">

            @php
                $getRouteName = Route::currentRouteName();

                $listMenu = collect([
                    [
                        'name' => 'Dashboard',
                        'icon' => 'grid-fill',
                        'route' => 'dashboard',
                    ],
                ]);
            @endphp

            <ul>
                @foreach ($listMenu as $menu)
                    <li class="menu-item {{ $getRouteName == $menu['route'] ? 'active' : '' }}">
                        <a href="{{ route($menu['route']) }}" class='menu-link'>
                            <span><i class="bi bi-{{ $menu['icon'] }}"></i> {{ $menu['name'] }}</span>
                        </a>
                    </li>
                @endforeach

                @php
                    use App\Models\Menu;

                    // Ambil menu utama (tanpa parent_id)
                    $menus = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
                @endphp
                @foreach ($menus as $menu)
                    @php
                        // Cek apakah salah satu submenu aktif
                        $isActive = $menu->children->pluck('link')->contains($getRouteName);
                    @endphp

                    <li class="menu-item has-sub {{ $isActive ? 'active' : '' }}">
                        <a href="#" class="menu-link">
                            <span><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</span>
                        </a>
                        @if ($menu->children->isNotEmpty())
                            <div class="submenu">
                                <ul class="submenu-group">
                                    <li class="submenu-item">
                                        @foreach ($menu->children as $submenu)
                                            <a href="{{ route($submenu->link) }}"
                                                class="submenu-link {{ $submenu->link === $getRouteName ? 'active' : '' }}">{{ ucwords(strtolower($submenu->title)) }}</a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

</header>
