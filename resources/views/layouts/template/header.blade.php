<header class="mb-5">
    <div class="header-top">
        <div class="container ">
            <div class="logo">
                <a href="index.html" class="navbar-brand d-flex align-items-center">
                    <span class="fw-bold">Bengkel Bendot</span>
                </a>
            </div>
            <div class="header-top-right">
                <div x-data="{ open: false }" @click.outside="open = false">
                    <a @click="open = ! open" href="#" id="topbarUserDropdown"
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
                    <style>
                        .dropdownAldi {
                            position: absolute;
                            z-index: 1000;
                            background-color: #ffffff;
                            border: 1px solid #e0e0e0;
                            border-radius: 8px;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                            min-width: 200px;
                            padding: 10px 0;
                            list-style-type: none;
                            margin: 0;
                        }

                        .dropdownAldi li {
                            padding: 10px 10px;
                        }

                        .dropdownAldi li:hover {
                            background-color: #f5f5f5;
                            cursor: pointer;
                        }

                        .dropdownAldi li a,
                        .dropdownAldi li button {
                            color: #333;
                            text-decoration: none;
                            background: none;
                            border: none;
                            width: 100%;
                            text-align: left;
                            cursor: pointer;
                            font-size: 14px;
                        }

                        .dropdownAldi li a:hover,
                        .dropdownAldi li button:hover {
                            color: #007bff;
                            cursor: pointer;

                        }

                        .dropdownAldi li hr {
                            margin: 2px 0;
                            border: none;
                            border-top: 1px solid #e0e0e0;
                        }
                    </style>
                    <div x-show="open" class="position-absolute">
                        <ul class="dropdownAldi" aria-labelledby="topbarUserDropdown">
                            <a class="" href="{{ route('profile.edit') }}">
                                <li>
                                    {{ Auth::user()->name }}
                                </li>
                            </a>
                            <hr class="">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="dropdown">
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
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>
                        </li>

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
                </div> --}}

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar bg-primary">
        <div class="container">

            <ul>
                <li class="menu-item {{ 'dashboard' == 'dashboard' ? 'active' : '' }}">
                    <a wire:navigate href="{{ route('dashboard') }}" class='menu-link'>
                        <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                    </a>
                </li>

                @php
                    use App\Models\Menu;
                    $getRouteName = Route::currentRouteName();

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
                                            <a wire:navigate href="{{ route($submenu->link) }}"
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
