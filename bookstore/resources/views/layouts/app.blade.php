<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Leaf & Ledger' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|fraunces:600,700|space-grotesk:500,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="page-shell">
        <div class="page-orb orb-one"></div>
        <div class="page-orb orb-two"></div>

        <header class="site-header">
            <div class="container nav-row">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark">L&L</span>
                    <span class="brand-copy">
                        <strong>Leaf & Ledger</strong>
                        <small>Curated stories for thoughtful readers</small>
                    </span>
                </a>

                <nav class="nav-links">
                    <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
                    <a href="{{ route('books.index') }}" @class(['active' => request()->routeIs('books.*')])>Catalog</a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.*')])>Admin</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="button button-ghost">Logout</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('admin.login') }}" @class(['active' => request()->routeIs('admin.login')])>Admin Login</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="container page-content">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Please fix the following:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
