resources/views/components/navbar.blade.php
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-journal-richtext fs-4 me-2 text-primary"></i>
            <span class="fw-bold">Data Blog</span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            {{-- Main Navigation --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}"
                        href="{{ route('blogs.index') }}">
                        Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About
                    </a>
                </li>
            </ul>

            {{-- Search Form --}}
            <form class="d-flex me-3" action="{{ route('blogs.search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control border-end-0 rounded-pill rounded-end" type="search" name="q"
                        placeholder="Search articles..." aria-label="Search" value="{{ request('q') }}">
                    <button class="btn btn-outline-primary border-start-0 rounded-pill rounded-start" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Auth Buttons/Menu --}}
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar_url ?? '/api/placeholder/32/32' }}" class="rounded-circle me-2"
                            width="32" height="32" alt="Profile">
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-circle me-2"></i> Profile
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('blogs.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> New Post
                            </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- Add margin to body to account for fixed navbar --}}
<div class="mb-5 pt-5"></div>
