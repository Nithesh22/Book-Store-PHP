@extends('layouts.app', ['title' => 'Admin Login'])

@section('content')
    <section class="auth-card">
        <div>
            <p class="eyebrow">Staff Access</p>
            <h1>Sign in to manage the catalog</h1>
            <p>Staff credentials: <code>admin@leafandledger.test</code> / <code>password</code></p>
        </div>

        <form method="POST" action="{{ route('admin.login.store') }}" class="stack">
            @csrf
            <label>
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label>
            <button class="button" type="submit">Login</button>
        </form>
    </section>
@endsection
