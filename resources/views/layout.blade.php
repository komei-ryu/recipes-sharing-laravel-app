<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>
<body>
    <div class="container-fluid">
        <ul class="nav d-flex justify-content-end py-1">
            {{-- Check if there is a logged-in user. --}}
            @if (Auth::check())
                <li class="nav-item">
                    <a href="{{ route('recipe.index') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-decoration-none">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('registration.index') }}" class="nav-link">Register</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
            @endif
        </ul>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-4 mx-5">
            @yield('main')
        </div>
    </div>
</body>
</html>
